const DBScript = require('./sql/dbScripts.js');
// console.log(DBScript)

var app = require('http').createServer(handler);
var io = require('socket.io')(app);
var fs = require('fs');
var port = 3000;

app.listen(port);
console.log("server started listen on Port " + port);

var totalConnections = 0;
// const initialFile = '/game.html';
const initialFile = '/main.html';

var runningGames=[];
var CAHNSP = io.of('/CAHGame');
var DBNSP = io.of('/DB');
var LOBBYNSP = io.of('/lobby');

// var games=[];

// const nsp = io.of('/defGameid');
// var num = 0;

//answer http request
function handler (req, res) {
    var url = req.url;
    if (req.url == '/'){
        url = initialFile;
    }
    fs.readFile(__dirname + "/html" + url,
    function (err, data) {
        if (err) {
            res.writeHead(500);
            return res.end('Error loading ' + url);
        }
        res.writeHead(200);
        res.end(data);
    });
}

//TODO Lobby namespace
//CAH namespace
CAHNSP.on('connection', function(socket){
    // console.log('socket ' + socket.id + ' connected to namespace: ' + CAHNSP.name);    

    //gameloop
    socket.on('inGame', function(gameID, playerID){
        socket.join(gameID);
        console.log(socket.id + ' inGame: ' + gameID);

        DBScript.addPlayer(gameID, playerID, socket.id);

        // var roundData = [czar, BCID, WCID]; //TODO 
        //boolean:czar, String:BCID, StringArray:WCID

        var czar = true;
        var BC = '';
        var WC = [];
        var scoreboard = [];
        //send card information
        socket.emit('roundInfo', czar, BC, WC, scoreboard);

        //check all conntected
         
        // var req = "SELECT socketID FROM player WHERE gameID='" + gameID + "'";
        // dbConnection.query(req, function(err, result, fields) {
            
        // });
    });
});

//def namespace
io.on('connection', function (socket) {
    console.log(socket.id + " connected; " + io.sockets.server.eio.clientsCount);
    // var newPlayerID = getNewPlayerID();
    // socket.emit(playerID, newPlayerID);

    socket.on('disconnect', function(){
        console.log(socket.id + " disconnected; " + io.sockets.server.eio.clientsCount);
    });
});

//database 'hack'
//TODO in PHP auf html Seite schreiben
DBNSP.on('connection', function(socket) {
    socket.on('getGames', function(){
        var req = "SELECT gameID FROM games WHERE gamestate='waitStart'";
        dbConnection.query(req, function(err, result, fields){
            socket.emit('res', result);
        });
    });

    socket.on('createGame', function(userID, gameID, settings) {
        console.log('\n****Gamecreation****');
        console.log('user: ' + userID + ' tries to created game: ' + gameID + ' with settings: ' + settings);
        
        var req = "SELECT gameID FROM games WHERE gameID='" + gameID + "'";
        var res = dbConnection.query(req, function(err, result, fields) {
            if (result.length != 0){
              console.log('gameID allready taken');
              console.log('****creation failed****\n');
              socket.emit('duplicatedGameID', true);
            } else {
              DBScript.gameToDB(gameID, settings);
              console.log('****creation success****\n');
              socket.emit('duplicatedGameID', false);
            }
        });        
    });

    socket.on('joinGame', function(gameID){
        console.log('joinGame emitted: ' + gameID);
        var req = "SELECT numPlayer, maxPlayer FROM games WHERE gameID='" + gameID + "'";
        dbConnection.query(req, function(err, result, fields){
            var boolean;
            if (result[0].numPlayer >= result[0].maxPlayer){
                console.log('cant join full lobby');
                boolean = false;
            } else {
                boolean=true;
            }
            socket.emit('canJoinGame', boolean);
        });

    });
});

LOBBYNSP.on('connection', function(socket){
    
    socket.on('inWaitingLobby', function(gameID, playerID) {
        //join room
        socket.join(gameID);
        console.log(socket.id + ' joined waitingLobby: ' + gameID);

        var req = "SELECT numPlayer FROM games WHERE gameID='" + gameID + "'";
        dbConnection.query(req, function(err, result, fields){
            // console.log(result);
            if(result[0].numPlayer==0){
                var req3 = "UPDATE games SET master='" + socket.id + "' WHERE gameID='" + gameID + "'";
                dbConnection.query(req3);
            }
            var req2 = "UPDATE games SET numPlayer=numPlayer+1 WHERE gameID='" + gameID + "'";
            dbConnection.query(req2);
        });
        // DBScript.addPlayer(gameID, playerID, socket.id);
    });

    //only emitted by master
    //TODO load WC/BC
    socket.on('gameStart', function(gameID){
        // var numPlayerInLobby = io.of('lobby').adapter.rooms[gameID].length;

        var req = "SELECT numPlayer FROM games WHERE gameID='" + gameID + "'";
        dbConnection.query(req, function(err , result, fields) {
            // if (result[0].numPlayer>=3){
                var req = "UPDATE games SET gamestate = 'Running' WHERE gameid = '" + gameID + "'";
                dbConnection.query(req);
                // console.log(io.of('lobby').adapter.rooms);
                io.of('lobby').to(gameID).emit('startGame');
                console.log('started game: ' + gameID);
            // } else {
            //     console.log('not enough player');
            // }
        }) 
    });

    socket.on('disconnect', function(){
        console.log(socket.id + ' disconnected');

        var req = "SELECT gameID FROM games WHERE master='" + socket.id + "'";
        dbConnection.query(req, function(err, result, fields) {
            if (result.length!=0) {
                
            }
        });







        var gameID;
        var req = "SELECT gameID FROM player WHERE socketID='" + socket.id + "'";
        dbConnection.query(req, function(err, result, fields) {
            if (result.length!=0){
                gameID = result[0].gameID;
                var req4 = "SELECT gamestate, master FROM games WHERE gameID='" + gameID + "'";
                dbConnection.query(req, function(err, result, fields){
                    //noch in Lobby?
                    console.log(result);
                    if (result==='waitStart') {
                        //in Lobby
                        //update numPlayer in Lobby
                        var req2 = "UPDATE games SET numPlayer = numPlayer - 1 WHERE gameID='" + gameID + "'";
                        dbConnection.query(req2);

                        var req4 = "DELETE FROM games WHERE gameId='" + gameID + "' AND numPlayer=0 AND gamestate='waitStart'";
                        dbConnection.query(req4);
                    }
                });
                
                
            }
        });        
    });
})

// function getNewPlayerID() {
//     while(true) {
//         var newID = Math.random().toString(36).substring(2, 15);
//         var req = "SELECT playerID FROM player WHERE playerID='" + newID + "'";
//         dbConnection.query(req, function(err, result, fields) {
//             if (result.length===0) {
//                 return newID;
//             }
//         });
//     }
// }

// function getNewGameID(){
//     return '/defGameid';
//     while (true) {
//         var id = Math.random().toString(36).substring(2, 15);
//         if (getGame(id) == undefined) {
//             return id;
//         }
//     }
// }
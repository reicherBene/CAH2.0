const Game = require('./old/Game.js');
const Player = require('./old/Player.js');
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
    console.log('socket ' + socket.id + ' connected to namespace: ' + CAHNSP.name);    

    //gameloop
    socket.on('inGame', function(gameID, playerID){
        // socket.join(gameID);
        // var req = "INSERT INTO player (playerID, gameID, socketID) VALUES ('" + playerID + "', '" + gameID + "', '" + socket.id + "') ";
        // console.log(req);
        // dbConnection.query(req);
        console.log(socket.id + ' inGame: ' + gameID);
    });

    
    
});

//def namespace
io.on('connection', function (socket) {
    // console.log('connection of ' + socket.id);
    totalConnections++;
    // console.log('total connections: ' + totalConnections + ' (+) ' + socket.id);
    console.log(socket.id + " connected; " + io.sockets.server.eio.clientsCount);

    socket.on('disconnect', function(){
        // console.log('disconnection of ' + socket.id);
        totalConnections--;
        // console.log('total connections: ' + totalConnections + ' (-)');
        console.log(socket.id + " disconnected; " + io.sockets.server.eio.clientsCount);
    });
});

//database 'hack'
//TODO in PHP auf html Seite schreiben
DBNSP.on('connection', function(socket) {
    socket.on('getGames', function(){
        var req = "SELECT gameID FROM games WHERE gamestate='waitStart'";
        getGames(req, socket);
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
        console.log('canjoinGame emitted: ' + gameID);
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
        socket.join(gameID);
        console.log(socket.id + ' joined waitingLobby: ' + gameID);
        DBScript.addPlayer(gameID, playerID, socket.id);
    });

    socket.on('gameStart', function(gameID){
        var req = "SELECT numPlayer FROM games WHERE gameID='" + gameID + "'";
        dbConnection.query(req, function(err , result, fields){
            // if (result[0].numPlayer>=3){
                var req = "UPDATE games SET gamestate = 'Running' WHERE gameid = '" + gameID + "'";
                dbConnection.query(req);
                console.log(io.of('lobby').adapter.rooms);
                io.of('lobby').to(gameID).emit('startGame');
                console.log('started game: ' + gameID);
            // } else {
            //     console.log('not enough player');
            // }
        }) 
    });

    socket.on('disconnect', function(){
        console.log(socket.id + ' disconnected');
        var gameID;
        var req = "SELECT gameID FROM player WHERE socketID='" + socket.id + "'";
        dbConnection.query(req, function(err, result, fields){
            if (result.length!=0){
                gameID = result[0].gameID;
                var req2 = "UPDATE games SET numPlayer = numPlayer - 1 WHERE gameID='" + gameID + "'";
                dbConnection.query(req2);
                var req3 = "DELETE FROM player WHERE socketID = '" + socket.id + "'";
                dbConnection.query(req3);
                var req4 = "DELETE FROM games WHERE gameId='" + gameID + "' AND numPlayer=0 AND gamestate='waitStart'";
                dbConnection.query(req4);
            }
        });        
    });
})

function getGames(req, socket){
    dbConnection.query(req, function(err, result, fields){
        if (err) throw err;
        // handlerResult(null, result, socket);
        if (err) {
            console.log(err);
            return;
        }
        socket.emit('res', result)
        // console.log(result);
    });
}

// function getNewGameID(){
//     return '/defGameid';
//     while (true) {
//         var id = Math.random().toString(36).substring(2, 15);
//         if (getGame(id) == undefined) {
//             return id;
//         }
//     }
// }
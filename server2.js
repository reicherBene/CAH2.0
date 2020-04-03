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

//CAH namespace
CAHNSP.on('connection', function(socket){
    console.log('socket ' + socket.id + ' connected to namespace: ' + CAHNSP.name);

    socket.on('inWaitingLobby', function(gameID){
        socket.join(gameID);
        console.log(socket.id + ' joined waitingLobby: ' + gameID);
        DBScript.addPlayer(gameID);
    });

    socket.on('gameStart', function(gameID){
        var req = "UPDATE games SET gamestate = 'Running' WHERE gameid = '" + gameID + "'";
        dbConnection.query(req);
        io.of('CAHGame').to(gameID).emit('startGame');
        console.log('started game: ' + gameID);
    });

    //gameloop
    socket.on('inGame', function(gameID, playerID){
        socket.join(gameID);
        var req = "INSERT INTO player (playerID, gameID, socketID) VALUES ('" + playerID + "', '" + gameID + "', '" + socket.id + "') ";
        console.log(req);
        dbConnection.query(req);
        console.log(socket.id + ' joined game: ' + gameID);
    });

    socket.on('disconnect', function(){
        var req = "";
    })
    
});

//def namespace
io.on('connection', function (socket) {
    // console.log('connection of ' + socket.id);
    totalConnections++;
    console.log('total connections: ' + totalConnections + ' (+) ' + socket.id);

    socket.on('disconnect', function(){
        console.log('disconnection of ' + socket.id);
        totalConnections--;
        console.log('total connections: ' + totalConnections + ' (-)');
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
});

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

function getNewGameID(){
    return '/defGameid';
    while (true) {
        var id = Math.random().toString(36).substring(2, 15);
        if (getGame(id) == undefined) {
            return id;
        }
    }
}
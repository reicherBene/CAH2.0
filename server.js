// const Game = require('./js/game.js');

var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);

const numLobbyPlayer = 2;
var countPlayer = 0;
var countInGamePlayer = 0;
var totalConnections = 0;
var playerSelected = 0;
var players = [];
var games=[];


app.get('/', function(req, res){
  // console.log('basic file req')
  res.sendFile(__dirname + '/public/index.html');
});

app.get('/test', function(req, res){
  // console.log('basic file req')
  res.sendFile(__dirname + '/test.html');
});

app.get('/test2', function(req, res){
  console.log('test2 file req')
  res.sendFile(__dirname + '/test2.html');
});

app.get('/index.html', function(req, res){
  // console.log("index file req");
  res.sendFile(__dirname + '/public/index.html');
});

app.get('/index2.html', function(req, res){
  // console.log("index2 file req");
  res.sendFile(__dirname + '/public/index2.html');
});

app.get('/game', function(req, res){
  // console.log("game file req");
  res.sendFile(__dirname + '/public/game.html');
});

app.get('*', function(req, res){
  // console.log(req.url);
});

//Listen for a client connection 
io.on("connection", (socket) => {
  players.push(socket.id);
  totalConnections++;
  // console.log(players);
  // console.log(totalConnections + " total are connected");
  // console.log(socket.id + " user connected");
  // console.log("New Client is Connected!");
  
  socket.on('inLobby', function(){
  countPlayer++;
  // console.log(countPlayer + " are waiting in Lobby");
    if (countPlayer == 2){
      //start Game
      io.emit("all connected");
      console.log('try creating game now');
      games.push(new Game(Math.random().toString(36).substring(2, 15), players, undefined));
      console.log("created Game:: id: " + games[0].getId() + " players: " + games[0].getPlayers() + " settings: " + games[0].getSettings() + " ;");
    }
  });

  socket.on('selected', function(data){
    // console.log(data);
    playerSelected++;
    if (playerSelected == numLobbyPlayer){
      io.emit('allSelected');
      playerSelected = 0;
    }
  });

  socket.on('disconnect', function(){
    players = players.filter(function(element){
      if (element == socket.id){
        return false;
      }
      return true;
    });
    totalConnections--;
    // console.log("player left");
    // console.log(countPlayer + " still are connected");
    // console.log('user disconnected');
  });
});

//Listen the HTTP Server 
server.listen(3000, () => {
    console.log("Server Is Running Port: 3000");
});






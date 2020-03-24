var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

app.listen(3000);
console.log("server started");

function handler (req, res) {
    // console.log(req.url);
    // console.log(__filename);
    var url = req.url;
    if (req.url == '/'){
        url = '/game.html';
    }
    fs.readFile(__dirname + url,
    function (err, data) {
        if (err) {
            res.writeHead(500);
            return res.end('Error loading ' + url);
        }
        res.writeHead(200);
        res.end(data);
    });
}

io.on('connection', function (socket) {
  console.log('fick dich');
  socket.on('sbRequest',function(){
      socket.emit('sbSend', ['player1', 'player2', 'player3']);
  });
});
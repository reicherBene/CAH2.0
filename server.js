
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

app.get('/', function(req, res){
    res.sendFile(__dirname + '/public/index.html');
});

io.on('connection', function(socket){
    console.log("nutzer connected");
    socket.broadcast.emit('hi');

   socket.on('disconnect',function(){
        console.log('user disconnected');
   })
  
    socket.on('chat message', function(msg){
        console.log("message is: " + msg);
        io.emit('chat message', msg);
    })

})

http.listen(3000, function(){
    console.log('listening on port 3000');
});

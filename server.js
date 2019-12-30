const http = require('http').Server();
const io = require('socket.io')(http);
const Redis = require('ioredis');
const port = 3000;

let redis = new Redis({
    port: 6379, // Redis port
    host: "192.168.126.108", // Redis host
    // family: 4, // 4 (IPv4) or 6 (IPv6)
    password: "secret",
    // db: 0
});
//подписываемся на канал указаные в app/Events/ChartRealTimeEvent.php
redis.subscribe('real-chart');
redis.on('message', function(channel, message){
    console.log('Message ' + message);
    console.log('Channel ' + channel);

    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

const requestHandler = (req, res) => {
    res.end('OK');
};

// const server = http.createServer(requestHandler);
// server.listen(port, (err) => {
//     if(err) {
//         return console.log('oops, something wrong')
//     }
//
//     console.log(`server is listening on ${port}`);
// });
http.listen(3000, function(){
    console.log('Listening on port: 3000');
});
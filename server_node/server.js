var io = require('socket.io')(6001);
console.log('Connected to port 6001');
io.on('error',function(socket){
	console.log('error');
})
io.on('connection',function(socket){
	console.log('Co nguoi ket noi toi'+socket.id);
	socket.on('live-chat',function(data){
		console.log(data);
	})
})
var Redis = require('ioredis');
var redis = new Redis(1000);
// Dang ki kenh
redis.psubscribe("*",function(error,count){
	//
})

redis.on('pmessage',function(parten,channel,message){
	console.log('kenh: '+channel)
	console.log('tin nhan:'+message)
	// console.log('parten: '+parten)
	message = JSON.parse(message);
	console.log(message);
	io.emit(channel+':'+message.event,message.data);
	
	console.log("send");
})
import express from "express";
import http from "http";
import path from "path";
import io from "socket.io";


const app = express();
const httpServer = http.Server(app);
const ioServer = io(httpServer);

const INDEX_NAME = './index.html';
const ABOUT_NAME = './some.txt';

app.use(express.static('public'));

app.get('/', (_req, res) => {
  res.sendFile(path.resolve(INDEX_NAME));
});

app.get('/about', (_req, res) => {
  res.sendFile(path.resolve(ABOUT_NAME));
});

ioServer.on('connection', (socket) => {
  socket.on('send message', function(msg) {
	ioServer.emit('receive message', msg);
  });
});

httpServer.listen(3000, () => {
  console.log('listening on 3000');
});

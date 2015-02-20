<?php
require __DIR__ . '/vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$handler = new App\Handler();

$server = IoServer::factory(
	new HttpServer(new WsServer(
		$handler
		)
	), 8123);
	

// Listen on 127.0.0.1:4444
$context = new \React\ZMQ\Context($server->loop);

$pull = $context->getSocket(\ZMQ::SOCKET_PULL);
$pull->bind("tcp://127.0.0.1:4444");
$pull->on('message', function ($data) use ($handler) {
	$handler->onZMQMessage($data);
});

$server->run();

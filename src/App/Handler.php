<?php

namespace App;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Handler implements MessageComponentInterface
{
    
    private $connections = [];

    public function onOpen(ConnectionInterface $conn)  {
		echo $conn->resourceId . ' connected' . PHP_EOL;
        $this->connections[$conn->resourceId] = $conn;
    }

    public function onMessage(ConnectionInterface $from, $msg)  {
        foreach ($this->connections as $receiver) {
            $receiver->send('> ' . $msg);
        }
    }

    public function onClose(ConnectionInterface $conn)  {
        unset($this->connections[$conn->resourceId]);
    }
    
    public function onError(ConnectionInterface $conn, \Exception $e) 
    {
    }
    
    public function onZMQMessage($message)
    {
		foreach ($this->connections as $receiver) {
            $receiver->send('NOTIFICATION: Something from the Web Server: ' . $message);
        }
	}
}

<?php

namespace App;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Handler implements MessageComponentInterface
{
    
    private $connections = [];

    public function onOpen(ConnectionInterface $conn)  {
        $this->connections[$conn->resourceId] = $conn;
    }

    public function onMessage(ConnectionInterface $from, $msg)  {
        foreach ($this->connections as $receiver) {
            if ($receiver == $from) continue;
            $receiver->send('> ' . $msg);
        }
    }

    public function onClose(ConnectionInterface $conn)  {
        unset($this->connections[$conn->resourceId]);
    }
    
    public function onError(ConnectionInterface $conn, \Exception $e) 
    {
    }
}

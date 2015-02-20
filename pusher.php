<?php

$context = new \ZMQContext();
$socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'pusher');
$socket->connect("tcp://127.0.0.1:4444");
$socket->send('Глей кви ръки! Туй аз ли съм!?');

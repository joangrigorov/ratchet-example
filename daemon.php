<?php
require __DIR__ . '/vendor/autoload.php';

use Ratchet\Server\IoServer;
$server = IoServer::factory(new App\Handler(), 8123);
$server->run();

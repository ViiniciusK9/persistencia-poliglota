<?php

declare(strict_types=1);

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once 'vendor/autoload.php';

$connection = new AMQPStreamConnection(
    'mensageria', 
    5672, 
    'guest', 
    'guest'
);

$channel = $connection->channel();
$channel->queue_declare('product_bought', auto_delete: false);

$channel->basic_consume('product_bought', callback: function (AMQPMessage $message) {
    echo "[x] Mensagem recebida: ".  $message->getBody() . PHP_EOL;
});

try {
    $channel->consume();
} catch (\Throwable $e) {
    var_dump($e);
}

$channel->close();
$connection->close();
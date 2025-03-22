<?php

declare(strict_types=1);

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

require_once 'vendor/autoload.php';

$mongodb = new Client('mongodb://username:password@documentos');

$database = $mongodb->selectDatabase('mongo-database');

$colcaoDeProdutos = $database->selectCollection('produtos');

/*
$resultado = $colcaoDeProdutos->insertOne([
    'nome' => 'Camiseta',
    'descricao' => 'Camiseta branca',
    'preco' => 50.00,
]);

echo "Foram inseridos {$resultado->getInsertedCount()} itens." . PHP_EOL;
echo "O ID do item inserido é {$resultado->getInsertedId()}." . PHP_EOL;
*/

$produto = $colcaoDeProdutos->findOne(['_id' => new ObjectId('67df156270060a5e6e0e1572')]);

var_dump($produto);

echo "Essa camisa custa {$produto->preco}." . PHP_EOL;
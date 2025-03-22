<?php

declare(strict_types=1);

use Laudis\Neo4j\ClientBuilder;
use Laudis\Neo4j\Contracts\TransactionInterface;
use Laudis\Neo4j\Databags\Statement;

require_once 'vendor/autoload.php';

$client = ClientBuilder::create()
    ->withDriver('bolt', 'bolt://neo4j:12345678@grafos:7687')
    ->withDefaultDriver('bolt')
    ->build();

//var_dump($client->verifyConnectivity());

//$result = $client->run('CREATE (u:Usuario {nome: $nome})', ['nome' => 'Vinicius']);

//var_dump($result->getSummary());

/*

$client->writeTransaction(static function (TransactionInterface $transaction) {
    $transaction->runStatements([
        Statement::create('CREATE (u:Usuario {nome: $nome})', ['nome' => 'Ana']),
        Statement::create('CREATE (u:Usuario {nome: $nome})', ['nome' => 'Maria']),
        Statement::create('CREATE (u:Usuario {nome: $nome})', ['nome' => 'Pedro']),
    ]);
});

*/

/*
$client->writeTransaction(static function (TransactionInterface $transaction) {
    $transaction->runStatements([
        Statement::create('MATCH (vinicius:Usuario {nome: "Vinicius"}), (maria:Usuario {nome: "Maria"}) CREATE (vinicius)-[:AMIGO_DE]->(maria)'),
        Statement::create('MATCH (vinicius:Usuario {nome: "Vinicius"}), (pedro:Usuario {nome: "Pedro"}) CREATE (vinicius)-[:AMIGO_DE]->(pedro)'),
        Statement::create('MATCH (ana:Usuario {nome: "Ana"}), (maria:Usuario {nome: "Maria"}) CREATE (ana)-[:AMIGO_DE]->(maria)'),
    ]);
});
*/


$result = $client->readTransaction(static function (TransactionInterface $transaction) {
    return $transaction->run('MATCH (vinicius:Usuario {nome: "Vinicius"})-[:AMIGO_DE*2]-(sugestao:Usuario) RETURN sugestao.nome');
});

/** @var \Laudis\Neo4j\Types\CyperMap $item */
foreach ($result as $record) {
    echo $record->get('sugestao.nome') . PHP_EOL;
}
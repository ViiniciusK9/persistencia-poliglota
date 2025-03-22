<?php

declare(strict_types=1);

use Elastic\Elasticsearch\ClientBuilder;

require_once 'vendor/autoload.php';

$client = ClientBuilder::create()
    ->setHosts(['http://busca_textual:9200'])
    ->build();

/*
$response = $client->indices()->create([
    'index' => 'meu_indice',
]);

var_dump($response);


$documento = [
    'nome' => 'Vinicius',
    'usuario' => 'viiniciusk9'
];

$response = $client->index([
    'index' => 'meu_indice',
    'type' => 'usuarios',
    'body' => $documento
]);

*/

$response = $client->search([
    'index' => 'meu_indice',
    'type' => 'usuarios',
    'body' => [
        'query' => [
            'match' => [
                'nome' => 'Vinicius'
            ]
        ]
    ]
]);

var_dump($response);

echo $response . PHP_EOL;
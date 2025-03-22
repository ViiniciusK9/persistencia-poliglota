<?php

declare(strict_types=1);

$redis = new Redis();

$redis->connect('chave_valor');


$redis->set('carrinho:1', json_encode([
    'produtos' => [
        ['id' => 1, 'nome' => 'Camiseta', 'preco' => 50.00],
        ['id' => 2, 'nome' => 'Calça', 'preco' => 150.00],
    ],
    'total' => 200.00,
]));

echo $redis->get('carrinho:1');
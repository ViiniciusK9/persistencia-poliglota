<?php

declare(strict_types=1);

$memcached = new Memcached();

$memcached->addServer('em_memoria', 11211);

//$memcached->set('chave', 'valor');

$date = new DateTime('tomorrow');

$memcached->set('chave-2', 'valor-2', $date->getTimestamp());

echo $memcached->get('chave') . PHP_EOL;

echo $memcached->get('chave-2') . PHP_EOL;
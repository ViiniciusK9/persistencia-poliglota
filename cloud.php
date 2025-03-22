<?php

declare(strict_types=1);

use Aws\DynamoDb\DynamoDbClient;

require 'vendor/autoload.php';

$dynamodb = new DynamoDbClient([
    'region' => 'us-west-2',
    'credentials' => require 'credentials.php',
]);

var_dump($dynamodb);
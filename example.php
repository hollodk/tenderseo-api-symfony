<?php

use \App\Client;

require_once(__DIR__.'/vendor/autoload.php');

$client = new Client([
    'key' => '23fe3bfd-0499-4e5b-be7c-209812aee49a',
]);

dump($client->getRandomArticle());

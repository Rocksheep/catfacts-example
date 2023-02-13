<?php

require_once('../vendor/autoload.php');

use Rocksheep\CatFacts\CatFacts;
use Rocksheep\CatFacts\HttpClient;

$curlClient = new \Http\Client\Curl\Client();
$httpClient = new HttpClient($curlClient);
$catFacts = new CatFacts($httpClient);
$facts = $catFacts->facts()->all();

var_dump($facts);

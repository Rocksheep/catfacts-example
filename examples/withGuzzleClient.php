<?php

require_once('../vendor/autoload.php');

use Rocksheep\CatFacts\CatFacts;
use Rocksheep\CatFacts\HttpClient;

$guzzleClient = new \GuzzleHttp\Client();
$httpClient = new HttpClient($guzzleClient);
$catFacts = new CatFacts($httpClient);
$facts = $catFacts->facts()->all();

var_dump($facts);

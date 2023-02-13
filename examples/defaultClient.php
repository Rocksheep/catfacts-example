<?php

require_once('../vendor/autoload.php');

use Rocksheep\CatFacts\CatFacts;

$catFacts = new CatFacts(); // Uses the default Client
$facts = $catFacts->facts()->all();

var_dump($facts);

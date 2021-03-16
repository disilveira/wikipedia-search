<?php

use App\Engine\Wikipedia\WikipediaEngine;
use App\Engine\Wikipedia\WikipediaParser;
use Symfony\Component\HttpClient\HttpClient;

require 'vendor/autoload.php';

$wikipedia = new WikipediaEngine(new WikipediaParser(), HttpClient::create());
$result = $wikipedia->search('php');

print_r($result);

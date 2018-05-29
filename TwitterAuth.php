<?php
require_once __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;
use Abraham\TwitterOAuth\TwitterOAuth;

$dotenv = new Dotenv(__DIR__);
$dotenv->load(); //.envが無いとエラーになる

$consumerKey = getenv('CONSUMER_KEY');
$consumerSecret = getenv('CONSUMER_SECRET');
$accessToken = getenv('ACCESS_TOKEN');
$accessTokenSecret = getenv('ACCESS_TOKEN_SECRET');

echo $consumerKey;


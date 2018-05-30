<?php
require_once __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAuth {
    public function __construct() {
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load(); //.envが無いとエラーになる

        $consumerKey = getenv('CONSUMER_KEY');
        $consumerSecret = getenv('CONSUMER_SECRET');
        $accessToken = getenv('ACCESS_TOKEN');
        $accessTokenSecret = getenv('ACCESS_TOKEN_SECRET');

        $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

    }

    public function Post(){

        $result = $connection->post("statuses/update", array("status" => ""));
        var_dump($result);
    }




}

<?php
require_once __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAuth {

    private $connection;

    public function __construct() {
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load(); //.envが無いとエラーになる

        $consumerKey = getenv('TWITTER_CONSUMER_KEY');
        $consumerSecret = getenv('TWITTER_CONSUMER_SECRET');
        $accessToken = getenv('TWITTER_ACCESS_TOKEN');
        $accessTokenSecret = getenv('TWITTER_ACCESS_TOKEN_SECRET');

        $this->connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

    }

    public function Post($message){

        $result = $this->connection->post("statuses/update", array("status" => $message));
        var_dump($result);
    }
}

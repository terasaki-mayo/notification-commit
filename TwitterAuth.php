<?php
require_once __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAuth {

    private $connection;

    public function __construct() {
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load(); //.envが無いとエラーになる

        $consumerKey = getenv('CONSUMER_KEY');
        $consumerSecret = getenv('CONSUMER_SECRET');
        $accessToken = getenv('ACCESS_TOKEN');
        $accessTokenSecret = getenv('ACCESS_TOKEN_SECRET');

        $this->connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

    }

    public function Post($message){

        $result = $this->connection->post("statuses/update", array("status" => $message));
        var_dump($result);
    }
}

$twiter = new TwitterAuth();
$twiter->Post("ねむみ");

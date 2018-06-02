<?php
require_once __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;

class GithubAuth {

    private $connection;

    public function __construct() {
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load(); //.envが無いとエラーになる

        $accessToken = getenv('GITHUB_ACCESS_TOKEN');

    }
}

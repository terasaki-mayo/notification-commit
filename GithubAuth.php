<?php
require_once __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;

class GithubAuth {

    private $accessToken;

    public function __construct() {
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load(); //.envが無いとエラーになる

        $this->accessToken = getenv('GITHUB_ACCESS_TOKEN');
        var_dump(getenv('GITHUB_ACCESS_TOKEN'));
    }

    public function GetInfo() {
        $query = <<<EOT
        query{
            viewer {
                login
                starredRepositories {
                    totalCount
                }
                repositories(first: 100) {
                    edges {
                        node {
                            name
                            languages
                        }
                    }
                }
              
            }
        }
EOT;

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => [
                    'User-Agent: My User Agent',
                    'Authorization: bearer '.$this->accessToken,
                    'Content-type: application/json; charset=UTF-8',
                ],
                'content' => json_encode(['query' => $query]),
            ],
        ];
        $context = stream_context_create($options);
        $contents = file_get_contents('https://api.github.com/graphql', false, $context);
        var_dump(json_decode($contents));
    
    }
}

$github = new GithubAuth();
$github->GetInfo();

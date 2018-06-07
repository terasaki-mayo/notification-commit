<?php
require_once __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;

class GithubAuth {

    private $accessToken;
    private $client;

    public function __construct() {
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load(); //.envが無いとエラーになる

        $this->accessToken = getenv('GITHUB_ACCESS_TOKEN');

        $this->client = new \Github\Client();
    }

    public function GetRepositories(){
        $query = <<<EOT
        query{
            viewer {
              repositories(first: 100) {
                edges {
                  node {
                    name
                  }
                }
              }
            }
          }
EOT;
        $contents = $this->client->api('graphql')->execute($query);
        return json_decode($contents, true);
    }

    public function GetInfo() {
        $query = <<<EOT
        query{
            repository(name: "notification-commit" owner:"Terasaki-Mayo"){
                ref(qualifiedName: "master") {
                    target {
                        ... on Commit {
                            history(first: 100) {
                                edges {
                                    node {
                                        committedDate
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
EOT;

        
        $contents = $this->postApi($query);
        var_dump(json_decode($contents, true));
    
    }

    public function postApi($query){
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
        return $contents = file_get_contents('https://api.github.com/graphql', false, $context);
    }

    public function calucCommits(){
        $repos = $this->GetRepositories();
        var_dump($repos);

    }
}

$github = new GithubAuth();
$github->calucCommits();

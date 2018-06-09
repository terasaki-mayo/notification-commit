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

    public function GetCountsCommits(){
        $query = <<<EOT
        query{
            viewer {
                repositories(first: 100) {
                    nodes {
                        defaultBranchRef {
                            target {
                                ...on Commit {
                                    history(since: "2017-01-01T00:00:00+00:00") {
                                        totalCount
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
        return json_decode($contents);
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

    public function countCommits($repos) {
        foreach($repos as $repo){
            $counts += $repo->defaultBranchRef->target->history->totalCount;
        }
        return $counts;
    }
}

$github = new GithubAuth();
$result = $github->GetCountsCommits();
$repos = $result->data->viewer->repositories->nodes;
$counts = $github->countCommits($repos);
var_dump($counts);


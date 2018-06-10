<?php
require_once __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;

class GithubAuth {

    private $accessToken;
    private $client;

    public function __construct() {
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load();

        $this->accessToken = getenv('GITHUB_ACCESS_TOKEN');
    }

    public function GetCountsCommits(){
        $date = date("c",strtotime("-1 week"));
        $query = <<<EOT
        query{
            viewer {
                repositories(first: 100) {
                    nodes {
                        defaultBranchRef {
                            target {
                                ...on Commit {
                                    history(since: "{$date}") {
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

    public function countCommits($datas) {
        $repos = $datas->data->viewer->repositories->nodes;
        foreach($repos as $repo){
            $counts += $repo->defaultBranchRef->target->history->totalCount;
        }
        return $counts;
    }
}


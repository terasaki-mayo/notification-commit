<?php

require_once "GithubAuth.php";
require_once "TwitterAuth.php";

$github = new GithubAuth();
$result = $github->GetCountsCommits();
$counts = $github->countCommits($result);
var_dump($counts);

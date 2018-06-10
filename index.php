<?php

require_once "GithubAuth.php";
require_once "TwitterAuth.php";

$github = new GithubAuth();
$result = $github->GetCountsCommits();
$counts = $github->countCommits($result);

$twitter = new TwitterAuth();
$twitter->PostToTwitter("今週は" . $counts . "回commitしました。" );

<?php

    //require
    require_once __DIR__.'/vendor/autoload.php';

    //for .env
    use Dotenv\Dotenv;

    $dotenv = new Dotenv(__DIR__);
    $dotenv->load(); //.envが無いとエラーになる


    //利用 ///////////////////////////////////

    //.env
    //変数名が他の環境変数と被らないように注意
    $name = getenv('TEST_NAME');
    echo $name;


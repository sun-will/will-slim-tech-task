<?php

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterService {
    private $data;
    private $connection;

    public function __construct(){
        $this->connection = new TwitterOAuth(
            getenv('TWITTER_CONSUMER_KEY'), 
            getenv('TWITTER_CONSUMER_SECRET'), 
            getenv('TWITTER_ACCESS_TOKEN'), 
            getenv('TWITTER_ACCESS_TOKEN_SECRET')
        );
    }

    public function fetchTweets(string $username) {
        return $this->connection->get(
            "statuses/user_timeline", 
            ["screen_name" => $username]
        );
    }
}
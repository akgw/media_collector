<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use config\Twitter;
use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;


class TwitterController extends Controller
{
    private $connection;

    public function __construct()
    {
        $twitter = new Twitter();
        $this->connection = new TwitterOauth($twitter->getConsumerKey(), $twitter->getConsumerSecret(), $twitter->getTwetterapi1(), $twitter->getTwetterapi2());
    }

    public function index()
    {
        $tweets_params = ['q' => '夜景,きれい OR キレイ OR 綺麗' ,'count' => '10'];

        $response = $this->connection->get('search/tweets', $tweets_params);

        if (empty($response->statuses)) {
            return view('tweet');
        }
        $tweets = [];
        foreach ($response->statuses as $key =>  $status) {
            $tweets[$key] = [
              'text' => $status->text,
            ];
        }



        return view('tweet')->with('tweets', $tweets);
    }


}

<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use config\Twitter;
use App\Http\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class TwitterController extends Controller
{
    private $connection;


    public function __construct()
    {
        $twitter = new Twitter();

        $stack = HandlerStack::create();

        $middleware = new Oauth1([
            'consumer_key'    => $twitter->getConsumerKey(),
            'consumer_secret' => $twitter->getConsumerSecret(),
            'token'           => $twitter->getTwetterapi1(),
            'token_secret'    => $twitter->getTwetterapi2(),
        ]);

        $stack->push($middleware);

        $client = new Client([
            'base_uri' => 'https://api.twitter.com/1.1/',
            'handler' => $stack,
            'auth' => 'oauth'
        ]);

        $this->connection = $client;
    }

    public function index(Requests\SearchRequest $request)
    {
        $word = $request->input('word') ?: '夜景,きれい OR キレイ OR 綺麗';

        $tweets_params = ['q' => $word, 'count' => '10'];

        $response = $this->connection->get('search/tweets.json', ['query' => $tweets_params]);

        if ($response->getStatusCode() !== 200) {
            return view('tweet');
        }
        $body = json_decode($response->getBody()->getContents());

        return view('tweet')->with([
            'tweets' => $body->statuses,
            'word' => $word,
        ]);
    }
}

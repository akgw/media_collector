<?php

namespace config;

class twitter
{
    private $CONSUMERSECRET;
    private $CONSUMERKEY;
    private $TWETTERAPI1;
    private $TWETTERAPI2;


    public function __construct()
    {
        $this->CONSUMERKEY = env('CONSUMERKEY', '');
        $this->CONSUMERSECRET = env('CONSUMERSECRET', '');
        $this->TWETTERAPI1 = env('TWETTERAPI1', '');
        $this->TWETTERAPI2 = env('TWETTERAPI2', '');
    }

    public function getConsumerKey()
    {
        return $this->CONSUMERKEY;
    }

    public function getConsumerSecret()
    {
        return $this->CONSUMERSECRET;
    }

    public function getTwetterapi1()
    {
        return $this->TWETTERAPI1;
    }

    public function getTwetterapi2()
    {
        return $this->TWETTERAPI2;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

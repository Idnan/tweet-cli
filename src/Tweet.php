<?php

namespace Idnan\TweetCLI;

/**
 * Class Tweet
 */
class Tweet
{

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $cookie;

    /**
     * Tweet constructor.
     *
     * @param string $username username
     * @param string $password password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Create a temp. cookie
     *
     * @author Adnan Ahmed <mahradnan@hotmail.com>
     *
     */
    public function createCookie()
    {
        $this->cookie = fopen('cookie.txt', 'w');
    }

    /**
     * Grab login tokens
     *
     * @author Adnan Ahmed <adnan.ahmed@tajawal.com>
     *
     */
    public function getLoginToken()
    {

    }
}
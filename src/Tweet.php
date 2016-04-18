<?php

namespace Idnan\TweetCLI;

/**
 * Class Tweet
 */
class Tweet
{

    /**
     * Fake user agent
     */
    const AGENT = 'Mozilla/5.0';

    /**
     * Cookie
     */
    const COOKIE = 'cookie.txt';

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
    private $tweet;

    /**
     * Tweet constructor.
     *
     * @param string $username username
     * @param string $password password
     * @param string $tweet    tweet
     */
    public function __construct($username, $password, $tweet)
    {
        $this->username = $username;
        $this->password = $password;
        $this->tweet    = $tweet;
    }

    /**
     * Start the tweet process
     *
     * @author Adnan Ahmed <adnan.ahmed@tajawal.com>
     *
     */
    public function begin()
    {
        $this->createCookie();

        $token = $this->getLoginToken();
        $this->login($token);

    }

    /**
     * Create a temp. cookie
     *
     * @author Adnan Ahmed <mahradnan@hotmail.com>
     *
     */
    private function createCookie()
    {
        fopen(static::COOKIE, 'w');
    }

    /**
     * Grab login tokens
     *
     * @return string
     *
     * @author Adnan Ahmed <adnan.ahmed@tajawal.com>
     *
     */
    private function getLoginToken()
    {
        $cmd = 'curl -s -b "' . static::COOKIE . '" -c "' . static::COOKIE . '" -L -A "' . static::AGENT . '" "https://mobile.twitter.com/session/new"';
        exec($cmd, $result);

        $str = implode('', $result);

        $regex = '/authenticity_token.+?value=\"(.*?)\"/';

        preg_match($regex, $str, $matches);

        return $matches[1];
    }

    private function login($token)
    {
        $cmd = 'curl -s -b "' . static::COOKIE . '" -c "' . static::COOKIE . '" -L -A "' . static::AGENT . '" -d "authenticity_token=' . $token . '&username=' . $this->username . '&password=' . $this->password . '" "https://mobile.twitter.com/session"';
        exec($cmd, $result);
    }
}
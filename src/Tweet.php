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
     * @param $username
     * @param $password
     * @param $tweet
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
     * @author Adnan Ahmed <mahradnan@hotmail.com>
     *
     */
    public function begin()
    {
        $this->createCookie();

        $token = $this->getLoginToken();
        $this->login($token);
        $tweetToken = $this->getComposeTweetToken();
        $this->tweet($tweetToken);
        $logoutToken = $this->getLogoutToken();
        $this->logout($logoutToken);

        $this->deleteCookie();
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
     * @author Adnan Ahmed <mahradnan@hotmail.com>
     *
     */
    private function getLoginToken()
    {
        echo "[+] Fetching login token..." . PHP_EOL;

        $cmd = 'curl -s -b "' . static::COOKIE . '" -c "' . static::COOKIE . '" -L -A "' . static::AGENT . '" "https://mobile.twitter.com/session/new"';
        exec($cmd, $result);

        return $this->getToken($result);
    }

    /**
     * Login
     *
     * @param $token
     *
     * @author Adnan Ahmed <mahradnan@hotmail.com>
     *
     */
    private function login($token)
    {
        echo "[+] Submitting login form..." . PHP_EOL;

        $cmd = 'curl -s -b "' . static::COOKIE . '" -c "' . static::COOKIE . '" -L -A "' . static::AGENT . '" -d "authenticity_token=' . $token . '&username=' . $this->username . '&password=' . $this->password . '" "https://mobile.twitter.com/session"';
        exec($cmd, $result);
    }

    /**
     * Grab login token
     *
     * @return string
     *
     * @author Adnan Ahmed <mahradnan@hotmail.com>
     *
     */
    private function getComposeTweetToken()
    {
        echo "[+] Getting token to composer tweet..." . PHP_EOL;

        $cmd = 'curl -s -b "' . static::COOKIE . '" -c "' . static::COOKIE . '" -L -A "' . static::AGENT . '" "https://mobile.twitter.com/compose/tweet"';
        exec($cmd, $result);

        return $this->getToken($result);
    }

    /**
     * Tweet
     *
     * @param $token
     *
     * @author Adnan Ahmed <mahradnan@hotmail.com>
     *
     */
    private function tweet($token)
    {
        echo "[+] Tweet tweet tweet tweet (check your profile)..." . PHP_EOL;

        $cmd = 'curl -s -b "' . static::COOKIE . '" -c "' . static::COOKIE . '" -L -A "' . static::AGENT . '" -d "wfa=1&authenticity_token=' . $token . '&tweet[text]=' . $this->tweet . '&commit=Tweet" "https://mobile.twitter.com/compose/tweet"';
        exec($cmd, $result);
    }

    /**
     * Get logout token
     *
     * @return string
     *
     * @author Adnan Ahmed <mahradnan@hotmail.com>
     *
     */
    private function getLogoutToken()
    {
        echo "[+] Getting token to logout..." . PHP_EOL;

        $cmd = 'curl -s -b "' . static::COOKIE . '" -c "' . static::COOKIE . '" -L -A "' . static::AGENT . '" "https://mobile.twitter.com/account"';
        exec($cmd, $result);

        return $this->getToken($result);
    }

    /**
     * Logout
     *
     * @param $token
     *
     * @author Adnan Ahmed <mahradnan@hotmail.com>
     *
     */
    private function logout($token)
    {
        echo "[+] Logging out..." . PHP_EOL;

        $cmd = 'logout=$(curl -s -b "' . static::COOKIE . '" -c "' . static::COOKIE . '" -L -A "' . static::AGENT . '" -d "authenticity_token=' . $token . '" "https://mobile.twitter.com/session/destroy")';
        exec($cmd, $result);
    }

    /**
     * Delete cookie
     *
     * @author Adnan Ahmed <mahradnan@hotmail.com>
     *
     */
    private function deleteCookie()
    {
        unlink(static::COOKIE);
    }

    /**
     * Parse html to grab token
     *
     * @param $result
     *
     * @return string
     *
     * @author Adnan Ahmed <mahradnan@hotmail.com>
     *
     */
    private function getToken($result)
    {
        $html  = implode('', $result);
        $regex = '/authenticity_token.+?value=\"(.*?)\"/';

        preg_match($regex, $html, $matches);

        return $matches[1];
    }
}
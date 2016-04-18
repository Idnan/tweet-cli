# Tweet Through CLI

This script can log into your Twitter account and post a new tweet, all without the official OAuth API.

## System requirements
* *nix OS
* curl

## Installation
* Download the [phar file from here](https://github.com/Idnan/tweet-cli/releases/download/1.0.0/tweet-cli.phar)
* sudo chmod -R 755 tweet-cli.phar
* sudo mv tweet-cli.phar /usr/local/bin/tweet-cli

## Usage

Run this command to tweet

```
tweet-cli -u<twitter_username> -p<twitter_password> --tweet="Your tweet message"
```
![Image](http://i.imgur.com/JCiAH69.gif)

## Known issues
* This script is 100% dependent on twitter html. So it will not work if twitter update their website, so don't rely on it 100%.
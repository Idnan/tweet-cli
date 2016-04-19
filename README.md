# Tweet CLI

A little utility to help developers tweet directly from their CLI.

## Motivation

To ease the pain of opening a browser, heading to twitter to tweet and to avoid getting distracted by other things that might catch your eye out there, I was tempted to make this utility, that lets you tweet without any hassle, for cli. Why cli? Because bash is something that most of the developers have open all the time.

## Installation

* Download the [phar file from here](https://github.com/Idnan/tweet-cli/releases/download/1.0.0/tweet-cli.phar)
* sudo chmod -R 755 tweet-cli.phar
* sudo mv tweet-cli.phar /usr/local/bin/tweet-cli

## Usage

```
tweet-cli -u<twitter_username> -p<twitter_password> --tweet="Your tweet message"
```

## Example

```
tweet-cli -u "username" -p "p@ssw0r3" --tweet="Tweet through your CLI by @idnan_se"
```
![Image](http://i.imgur.com/JCiAH69.gif)

## License

MIT © Adnan Ahmed

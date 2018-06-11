# post counts commit to Twitter

## Description
Count the number of commits of github in the past week.  
Post counts to Twitter using Twitter API.


## Requirement

- PHP5.6.30+

## Usage

1. create  `.env`  file
```
TWITTER_CONSUMER_KEY=[XXX]
TWITTER_CONSUMER_SECRET=[XXX]
TWITTER_ACCESS_TOKEN=[XXX]
TWITTER_ACCESS_TOKEN_SECRET=[XXX]
GITHUB_ACCESS_TOKEN=[XXX]
```
2. Run
```
$ php index.php
```

## Installation

    $ git clone https://github.com/Terasaki-Mayo/notification-commit.git  
    

Installation is possible using Composer.  
If you don't already use Composer, you can download the composer.phar binary:

```
$ curl -sS https://getcomposer.org/installer | php
```
Then install the library:  
```
$ composer install
```
  
## Author

[@Terasaki-Mayo](https://github.com/Terasaki-Mayo)

## License
[MIT](http://b4b4r07.mit-license.org)

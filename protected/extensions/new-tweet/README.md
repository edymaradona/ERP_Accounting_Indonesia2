Yii New Tweet Widget
====================

This is the new Yii tweet master widget extension that was created by seaofclouds which has been rendered not functional thanks to Twitter  killing off API 1.0.

Installation
============

Since you are now required to have an API key, you need to have a backend handler now, which I created as a custom action.

1 - Go to the TweetFetch class and put in the Twitter authentication values.

2 - In whatever controller you'd like to use, add this to your actions() method, you may name your action something other than 'get_tweets' if you want, and make sure you reference the TweetFetch CAction class properly:

```php
public function actions() {
    return array(
        'get_tweets' => array(
            'class' => 'ext.new-tweet.TweetFetch'
        )
    );
}
```
    
3 - The widget declaration is the same, but I added some other parameters in there:

```php
$this->widget('ext.new-tweet.Tweets', array(
    'id' => 'twitter-feed',
    'csrfToken' => true, // set this to true if you enabled CSRF validation
    'proxyController' => $this->createUrl('my_controller/get_tweets'), // You need to specify this!
    'username' => array('google', 'facebook', 'twitter'), // as you can see you can add an array of usernames
    'cssFile' => false, // if you don't want the default CSS file
    //'cssFile'=>Yii::app()->theme->baseUrl.'/css/tweet-master.css', // customize your twitter css file
    'options' => array(
        'avatar_size' => 32,
        'template' => '{user} {text} - {time} - {reply_action} - {retweet_action} - {favorite_action}',
        'count' => 6
    )
));
```
Thanks To:
======
https://github.com/StanScates
https://github.com/seaofclouds

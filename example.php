<?php

use \App\Client;

require_once(__DIR__.'/vendor/autoload.php');

/**
 * We have made this helper example.php file to ease your integration,
 * but this short comment is the short version if that is easier to read
 *
 * $client = new Client()
 *
 * $client->signup([
 *  'email' => $email,
 *  'name' => $name,
 * ]);
 *
 * $client->setApiKey($result->api_key);
 *
 * $client->getRandomArticle();
 */

/**
 * If you have your api key already, simply
 *
 * $client = new Client(['key' => $key]);
 *
 * $client->getRandomArticle();
 */


$email = 'test-user@example.com'; // your email
$name = 'John Doe'; // your name

/**
 * Initialize the wrapper
 */
$client = new Client();


/**
 * Signup with a new user to get your api key
 */
write("First we will create a new account for you, hold on");

$result = $client->signup([
    'email' => $email,
    'name' => $name,
]);

if (isset($result->error)) {
    dump($result);
    die();

} else {
    dump($result);
}


/**
 * Persist api credentials
 */
$filename = persistCredentials($email, $result);

write("Saving your API credentials here ".$filename);


/**
 * Set the new api key to TenderSEO client
 */
$client->setApiKey($result->api_key);


/**
 * Fetch an random article
 */
write("Now we are going to fetch a random article from our database for your pleasure :)");

$article = $client->getRandomArticle();

dump($article);


write('Now, go on and play with our API as you like :)');

function write($message)
{
    echo PHP_EOL;
    echo $message;
    echo PHP_EOL;

    sleep(3);
}

function persistCredentials($email, $result)
{
    $filename = __DIR__.'/api_key_'.$email;

    $body = <<<EOF
Your API key information is persisted here:

username: {$email}
password: {$result->password}
dashbord: {$result->dashboard_url}
api key: {$result->api_key}

Looking forward to work with you.

// TenderSEO

EOF;

    file_put_contents($filename, $body);

    return $filename;
}

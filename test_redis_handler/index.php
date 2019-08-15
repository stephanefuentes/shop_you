<?php

/*
 * This file is part of the Predis package.
 *
 * (c) Daniele Alessandri <suppakilla@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
require 'vendor/autoload.php';
require 'CartSessionHandler.php';

// This example demonstrates how to use Predis to save PHP sessions on Redis.
//
// The value of `session.gc_maxlifetime` in `php.ini` will be used by default as
// the TTL for keys holding session data but this value can be overridden when
// creating the session handler instance using the `gc_maxlifetime` option.
//
// NOTE: this class requires PHP >= 5.4 but can be used on PHP 5.3 if a polyfill
// for SessionHandlerInterface is provided either by you or an external package
// like `symfony/http-foundation`.
//
// See http://www.php.net/class.sessionhandlerinterface.php for more details.
//

// Instantiate a new client just like you would normally do. Using a prefix for
// keys will effectively prefix all session keys with the specified string.
$client = new Predis\Client(array(
    'host' => '51.15.217.149',
    'port' => 6379,
    'password' => "3XT6Fj5yc",
    'database' => 15,
), array('prefix' => 'cart:'));

// Set `gc_maxlifetime` to specify a time-to-live of 5 seconds for session keys.
$handler = new CartSessionHandler($client, array('gc_maxlifetime' => 100));

// Register the session handler.
$handler->register();

// We just set a fixed session ID only for the sake of our example.

session_start();

// $_SESSION['name'] = 'toto';

// if (isset($_SESSION['cart'])) {
//     echo "Session has `foo` set to {$_SESSION['cart']}", PHP_EOL;
// } else {
//     $_SESSION['cart'] = $value = mt_rand();
//     echo "Empty session, `foo` has been set with $value", PHP_EOL;
// }
// var_dump($_SESSION);


$_SESSION = [
    'cart' =>
    [
        [
            "product_id" => 5,
            "product_name" => "test produit",
            "product_price" => 50,
            "product_quantity" => 2
        ],
        [
            "product_id" => 6,
            "product_name" => "test produit 2",
            "product_price" => 10,
            "product_quantity" => 21
        ]
    ],
    "logged" => true,
    "id_user" => 56456456,
    "first_name" => " test f name",
    'last_name' => "test l name",
    "admin" => false
];

//dump($_SESSION['cart']);
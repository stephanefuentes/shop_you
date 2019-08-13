<?php


// ALLEZ VOIR LE SITE REDIS , TRES BIEN FAIS AVEC SON DICTATORIEL

// RMQ 9ms pour 10 000 requettes , avec 10 go de RAM

//  MongoDB 90 000 requettes pas seconde / s


//RMQ : require "vendor/autoload.php";  si on utilise composer

// quand on installe avec GIT Clone
// require 'predis/autoloard.php';
// PredisAutoloader::register();


require "vendor/autoload.php";

// Les Typpes de variables

// 1 .String


// 2. List => equivalent à un tableau unidimensionnel en PHP
    // clé => valeur ( autant de valeur que l'on veut)
            //panier => [produit1 , produit2]


// 3.HASH
        // [
        //     'nom' => 'valeur',
        //     'prenom' =>'valeur'
        // ]

// 4.SET
    //[valeur1 , valeur1] // pas possible car les valeurs doivent être unique

// 5.SORTED SET



// *****************************************************************************************


//$redis = new Predis\Client(); // par défaut host = localhost ou 127.0.0.1 et aussi port = 6379


//  pour un serveur distant
$redis = new Predis\Client(
    [
        "scheme" => "tcp",
        "host" => "51.15.217.149",
        "port" =>  "6379",
        "password" => "3XT6Fj5yc"
    ]

);

// en ligne de commande redis-cli -h 51.15.217.149 -p 6379 -a 3XT6Fj5yc


// ----------------------- EXEMPLE DE COMMANDE
$redis->select(11); // on se brancle sur db 2 ( il y en a 16 par defaut)
$redis->set("message", "Bonjour à tous!");



// [
//     'nom' => "valeur",
//     'prenom' => "valeur 2 "
// ]
$redis->hset("personne", "nom", "nom personne 1");
$redis->hset("personne", "prenom", "prénom personne 1");

echo $redis->hget("personne", "prenom");

$redis->hmset("personne2", [
    "nom" => "nom personne 2",
    "prenom" => "prenom personne 2"
]);


$data  = $redis->hgetall("personne");
$data2  = $redis->hgetall("personne2");

$redis->hset("personne", "age", 30); //  30 sera en string dans la base de donné redis
var_dump($data, $data2);


$redis->hincrby("personne", "age", 12); //  ajoute 12 a age de personne



$redis->sadd("langues", "français");
$redis->sadd("langues", "anglais");
// les 2 lignes du dessus sont éagele à la ligne du dessous
$redis->sadd("langues", ["français", "anglais"]);

$data = $redis->smembers("langues");
var_dump($data);
// *****************************************************************************************

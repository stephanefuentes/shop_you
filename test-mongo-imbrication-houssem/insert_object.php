<?php

require "vendor/autoload.php";
require "User.php";
require "Classe.php";


// se connecter au serveur de la base de données
$client = new MongoDB\Client("mongodb://51.15.217.149:27718");

// si la base de données n'existe pas il va la créer
// si la collection (équivalent à table en SQL) n'existe pas il va la créer
$collection = $client->shop->user;


$classe1 = new Classe();
$classe1->setNom("ANGSFY");

$classe2 = new Classe();
$classe2->setNom("3WA");

$user = new User();
$user->setFirst_name("Test");
$user->setLast_name("Test Last name");
$user->setAge(11);
$user->setClasse([$classe1, $classe2]);


$collection->insertOne($user);


// $result = $collection->findOne(["first_name" => "Test"]);
// echo $result['first_name'] . PHP_EOL;
// $result_string = MongoDB\BSON\fromPHP($result);

// $user = MongoDB\BSON\toPHP($result_string, ['root' => "User"]);
// var_dump($user);
// echo $user->getFirst_name() . PHP_EOL;

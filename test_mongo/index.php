<?php

$idStephMdb = 11;



require "vendor/autoload.php";


// se connecter au serveur de la base de données, ca sera TOUJOURS l'IP pour le host, puis le port aprés les : 
$client = new MongoDB\Client("mongodb://51.15.217.149:27718");

// si la base de données n'existe pas il va la créer
// si la collection (équivalent à table en SQL) n'existe pas il va la créer, shop11 correspond au non de la base de donnée, et 
$collection = $client->shop11->user;



//$user = $collection->insertOne(["name" => "user 1", "last_name" => "last 1"]);

// $user = $collection->insertMany([
//     ["name" => "user 4", "last_name" => "last 4"],
//     ["name" => "user 5", "last_name" => "last 5"],
//     ["name" => "user 6", "last_name" => "last 6"]

// ]);


// Récupère la liste des identifiants des dernier documents ajoutés
// $users = $collection->getInsertedIds();


// Récupère tout
$users = $collection->find();

    $results = $users->toArray();
    foreach($results as $result)
    {
        echo $result["name"].PHP_EOL;
    }

// recuperation ( multiple évnetuellement ) par critères ( il peut en avoir plusieur)
$users = $collection->find(["last_name" => "last_2"]);



// recuperation  par critères ( il peut en avoir plusieur) du premier trouvé
$users = $collection->findOne(["last_name" => "last_2"]);


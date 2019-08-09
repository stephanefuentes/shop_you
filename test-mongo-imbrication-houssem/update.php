<?php


require "vendor/autoload.php";


// se connecter au serveur de la base de données
$client = new MongoDB\Client("mongodb://51.15.217.149:27718");

// si la base de données n'existe pas il va la créer
// si la collection (équivalent à table en SQL) n'existe pas il va la créer
$collection = $client->shop->user;

// parcours la liste des documents et ne modifie que le 1er
$collection->updateOne(
    ["name" => "user 2" ,"age" => 30],
    ['$set' => ['last_name' => "XXX", 'age' => 50]]
);


// s'il trouve un resultat unique avec un name équivalent à "user 2"  il va effectuer la modification , si non ERREUR
$collection->findOneAndUpdate(
    ["name" => "user 2"],
    ['$set' => ['last_name' => "XXX"]]
);

// appliquer la même modification sur tous les documents qui ont le name "user 2"
$collection->updateMany(
    ["name" => "user 2"],
    ['$set' => ['last_name' => "XXX"]]
);

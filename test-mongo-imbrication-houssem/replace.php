<?php


require "vendor/autoload.php";


// se connecter au serveur de la base de données
$client = new MongoDB\Client("mongodb://51.15.217.149:27718");

// si la base de données n'existe pas il va la créer
// si la collection (équivalent à table en SQL) n'existe pas il va la créer
$collection = $client->shop->user;

// parcours la liste des documents et ne remplace que le 1er //sauf _id ne change pas
$collection->replaceOne(
    ["name" => "user 2"],
    ["last_name" => "nouveau name", "age" => 77, "first_name" => "nouveau first Name"]

);


// s'il trouve un resultat unique avec un name équivalent à "user 2"  il va effectuer la remplacement , si non ERREUR //sauf _id ne change pas
$collection->findOneAndReplace(
    ["name" => "user 2"],
    ["last_name" => "nouveau name", "age" => 77, "first_name" => "nouveau first Name"]
);

// appliquer le même remplacement sur tous les documents qui ont le name "user 2" //sauf _id ne change pas
$collection->ReplaceMany(
    ["name" => "user 2"],
    ["last_name" => "nouveau name", "age" => 77, "first_name" => "nouveau first Name"]
);

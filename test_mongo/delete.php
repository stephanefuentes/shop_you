<?php

require "vendor/autoload.php";
// se connecter au serveur de la base de données, ca sera TOUJOURS l'IP pour le host, puis le port aprés les :
$client = new MongoDB\Client("mongodb://51.15.217.149:27718");

// si la base de données n'existe pas il va la créer
// si la collection (équivalent à table en SQL) n'existe pas il va la créer, shop11 correspond au non de la base de donnée, et
$collection = $client->shop11->user;



// on peut passer un objet au fonction mongo de php ( a conditon que l'objet implemente MongoDB\BSON\Serializable et que public function bsonSerialize() soit renseigné')
// $user = new User();
// $user->setFirst_name("Test 6");
// $user->setLast_name("Test Last name 6");
// $user->setAge(11);

// $collection->insertOne($user);



// POUR LES DELETE  ----------------------------------------

// parcours la liste des documents et ne supprime que le 1er
$collection->deleteOne(
    ["name" => "user 2", "age" => 30]
);


// s'il trouve un resultat unique avec un name équivalent à "user 2" il va effectuer la modification , si non ERREUR ( si il trouve plusieur document avec le meme name donc)
$collection->findOneAndDelete(
["name" => "user 2"]
);

// appliquer la même suppression sur tous les documents qui ont le name "user 2"
$collection->updateMany(
["name" => "user 2"]
);
<?php


require "vendor/autoload.php";


// se connecter au serveur de la base de données
$client = new MongoDB\Client("mongodb://51.15.217.149:27718");

// si la base de données n'existe pas il va la créer
// si la collection (équivalent à table en SQL) n'existe pas il va la créer
// $collection = $client->shop->user;


// // insérer un seul Document (équivalent de la ligne en SQL)
// $user = $collection->insertOne(["name" => "user 1", "last_name" => "last 1"]);

// // Récupérer l'identifiant du dernier document insérer
// $user->getInsertedId();


// // insérer plusieurs documents
// $users = $collection->insertMany([
//     ["name" => "user 5", "last_name" => "last 2"],
//     ["name" => "user 6", "last_name" => "last 3"],
//     ["name" => "user 7", "last_name" => "last 4"]
// ]);
// // // Récupérer la liste des identifiants des  derniers documents ajouter
// $users->getInsertedIds();


// // récupération de la liste des documents dans la collection "user"
// $users = $collection->find();

// // convertir les résultats en tableaux
// $results = $users->toArray();

// foreach ($results as $result) {
//     echo $result['name'];
// }
// //récupération d'une liste des documents selon des critères de recherche
// $users = $collection->find(["last_name" => "last 2"]);

// // // récupération du premier document avec le critère passé en parametre
// $user = $collection->findOne(["last_name" => "last 2"]);
var_dump((new \MongoDB\BSON\UTCDateTime(new DateTime()))->toDateTime()->setTimeZone(new DateTimeZone('Europe/Paris')));

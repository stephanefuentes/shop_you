<?php
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
echo json_encode([
    "nom" => $nom,
    "prenom" => $prenom
]);

<?php 

if(isset($_POST["nom"]) && isset($_POST['prenom']))
{
$nom = $_POST["nom"];
$prenom = $_POST['prenom'];
echo "<p>Le nom est $nom et le prénom est $prenom</p>";
}else{
echo "<p>il n'y a pas de données envoyées </p>";
}
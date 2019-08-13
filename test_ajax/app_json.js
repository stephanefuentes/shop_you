"use strict";


$('form').submit(function (e) {
    e.preventDefault();

    var $this = $(this);

    var $notre_fonction = $.ajax({
        url: $this.attr('action'), // URL ou chemin du fichier/fonction à éxécuter 
        type: "POST", // le type de la méthode à éxécuter
        data: $this.serializeArray(), // données à envoyer au fichier/fonction PHP
        dataType: "json" // le type de retour 
    });
    $notre_fonction.done(function (result, status) {

        //result contient le retour du fichier php 
        // status => le statut de retour success ou fail

        console.log(result.prenom);
        console.log(result.nom);
    });
    $notre_fonction.fail(function (result, status, error) {

        //result => résultat du retour 
        // status => statut de retour
        // error => c'est quoi comme erreur


    });
    $notre_fonction.always(function () {
        console.log("Always")
    });
})
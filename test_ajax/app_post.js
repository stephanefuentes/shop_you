"use strict";


$('form').submit(function (e) {
    e.preventDefault();

    var $this = $(this);

    var $notre_fonction = $.post(
        $this.attr('action'), // URL ou chemin du fichier/fonction à éxécuter 
        $this.serializeArray(), // données à envoyer au fichier/fonction PHP
        "html" // le type de retour 
    );
    $notre_fonction.done(function (result, status) {

        //result contient le retour du fichier php 
        // status => le statut de retour success ou fail
        $this.html(result);

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
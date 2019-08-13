"use strict";


$('form').submit(function (event) {
    event.preventDefault();
    var $url = $(this).attr("action");
    var $form_content = $(this).serializeArray();
    var $this = $(this);
    var $notre_fonction = $.ajax({
        url: $url, // URL ou chemin du fichier/fonction à éxécuter 
        type: "POST", // le type de la méthode à éxécuter
        data: $form_content, // données à envoyer au fichier/fonction PHP
        dataType: "html" // le type de retour 
    });
                                //result contient le retour du fichier php 
                                // status => le statut de retour success ou fail (optionnel)
    $notre_fonction.done(function (result, status) {
        //alert("success")
        $this.html(result);
        
    });
    $notre_fonction.fail(function (result, status, error) {

        //result => résultat du retour 
        // status => statut de retour
        // error => c'est quoi comme erreur
    });

    $notre_fonction.always(function () {
        alert("Always")
    });
})
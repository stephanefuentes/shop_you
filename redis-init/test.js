"use strict";

<form action="index.php/product/add" method="post">
    <input type="text" name="nom">
        <input type="text" name="prenom">
            <input type="submit" value="ajouter">
</form>

            // appel à la fonction ajax

            $('form').submit(function(event){
                event.preventDefault();
    // 1er parametre:  récupération des données du formulaire
    var $url = $(this).attr("action");
        
            // appel à la fonction ajax
    var $form = $(this);
    // $.ajax(
    //     //parametres
        

    //     // lors du success de l'exécution du fichier ou la fonction php 
            // mais il n'assure pas le bon fonctionnement/execution de la fonction 

    //     success: function()
    //     {

    //     }
    //     error: function
    // )

    $.ajax() .done(function(){

    }).fail(function(){

    }).always(function(){
        
    })
})
            

 $.post().done(function(){ // raccourci pour un ajax post, 

            }).fail(function(){

            }).always(function(){

            })


    $.get().done(function(){ // raccourci pour un ajax en Get

            }).fail(function(){

            }).always(function(){

            })
                })
                            
                        
                            
                            
                            
                            // appel à la fonction ajax
                            
                            jQuery.ajax()
                            
                            $.ajax("afficher.php")
                            $.ajax("index.php/product/show/2")
                            
                            var div1 = document.querySelector("#id_test");
                    
                            var $div2 = $("#id_test");


 /************************************************************************************** */               
    $.ajax(
        // url ou chemin à éxécuter
        url : "index.php/product/show/2", -- 1er PARAMETRE A PASSER
        // method, GET ou POST,             -- 2éme PARAMETRE A PASSER
        // les données a envoyée à php( optionnel), sérialisé, $form.serializeArray() [data],  -- 3 éme PARAMETRE A PASSER
        /// type de retour data-type (html, json ...)   -- 4 éme PARAMETRE A PASSER

/************************************************************************************** */ 
                
                            
)
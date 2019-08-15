<?php

session_start();

echo session_save_path();


// a l'interireur des fichiers session, on trouve par exemple,
sess_"-------"  // ou "--------------" est la value généré par la session

// on peut changer le nom de la session par default, avec par exxmpel
session_start("steph-le-beau") ;


//*********************************************************** */
$tab = [
    'name' => "houssem"
];

$tab_serialized = serialize($tab);
var_dump($tab_serialized);


var_dump(unserialize($tab_serialized));


/**** LORSQUE LES DONNEES DE SESSION SONT STOCKEES SUR LE SERVEUR? ELLE SONT SERIALI2E avec LE FORMAT SPECIFIQUE DE SESSION_ENCODE*/
$_SESSION = $tab;
session_encode(); //  
$out = session_encode();
var_dump($out);

//*********************************************************** */
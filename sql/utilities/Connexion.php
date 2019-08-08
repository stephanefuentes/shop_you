<?php


class Connexion
{
    private $cnx;


    public function __construct()
    {
        try {
            $this->cnx = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function __destruct()
    {
        // écrase le contenu de cnx
        $this->cnx = null;

        // écrase la variable cnx
        //unset($this->cnx);
    }


    public function querySQL($request, $execute_params)
    {
        $stmp = $this->cnx->prepare($request);
        $stmp->execute($execute_params);


        //  pour recuperer le dernier id si l'objet a éte ajouté
        return $this->cnx->lastInsertId();
    }


    // exemple de requette : getOne("SELECT * FROM product WHERE id=?",[20], "Product")
    public function getOne($request, $execute_params, $class)
    {

        $stmp = $this->cnx->prepare($request);
        $stmp->execute($execute_params);
        $stmp->setFetchMode(PDO::FETCH_CLASS, $class);

        return $stmp->fetch();


    }

    // exemple de requette : getMany("SELECT * FROM product", "Product")
    public function getMany($request, $class,  $execute_params = [])
    {


        $stmp = $this->cnx->prepare($request);
        $stmp->execute($execute_params);

        return  $stmp->fetchAll(PDO::FETCH_CLASS, $class);
       //$result = $this->cnx->fetchAll(PDO::FETCH_CLASS, 'Myclass');


    }


}
<?php



class Connexion
{

    private $db;

    public function __construct()
    {
        try {
            $client = new MongoDB\Client("mongodb://" . DB_HOST . ":" . DB_PORT);
            $this->db = $client->{DB_NAME};
        } catch (MongoDB\Driver\Exception\AuthenticationException  $e) {
            echo $e->getMessage();
            die;
        }
    }


    //  cette fonction va appellé ( de facon transparente pour nous ) la methode bsonSerialize() qui va convertir les données de notre objet en format "document bson" , qui est le format attendu la bdd MongoDb

    //  de meme, il faudra faire l'inverse lorsqu'on voudra recupérer un "document bson" ( la méthose bsonUnserialize(array $data) sera alors appellé de façon transparente pour nous ), afin de pouvoir re formater les données récuperer en objet tel qu'on l'a définit ( et ainsi pouvoir utiliser les différent get.. par exemple ) 
    public function addToDb($collection, $document)
    {
        $result = $this->db->$collection->insertOne($document);

        return $result->getInsertedId();
    }

    public function findOne($query, $collection)
    {

        // retourne un objet de type "document bson"
        $result = $this->db->$collection->findOne($query);
        return $result;
    }


    public function find($collection)
    {
        // renvoie un tableau d'objet de type "document bson"
        $result = $this->db->$collection->find();
        //dump($result->toArray());die();
        return $result;
    }
}

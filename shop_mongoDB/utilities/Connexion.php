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

    public function addToDb($collection, $document)
    {
        $result = $this->db->$collection->insertOne($document);

        return $result->getInsertedId();
    }

    
}

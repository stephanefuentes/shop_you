<?php

class Classe implements MongoDB\BSON\Serializable
{
    private $_id;
    private $nom;

    public function bsonSerialize()
    {
        return [
            '_id' => new MongoDB\BSON\ObjectId(),
            'nom' => $this->nom
        ];
    }


    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }
}
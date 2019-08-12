<?php



class User implements MongoDB\BSON\Serializable, MongoDB\BSON\Unserializable
{
    // proprietés
    
    private $_id;
    private $first_name;
    private $last_name;
    private $email;
   // private $created_at;
    private $password;
    private $admin;



    public function bsonSerialize()
    {
        return [
            //'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            //'created_at' => new \MongoDB\BSON\UTCDateTime(new DateTime()),
            'password' => password_hash($this->password, PASSWORD_BCRYPT),
            'admin' => $this->admin

        ];
    }

    public function bsonUnserialize(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        //$this->unserialized = true;

        //https://www.php.net/manual/fr/mongodb.persistence.deserialization.php#mongodb.persistence.typemaps

        //https://www.php.net/manual/fr/class.mongodb-bson-unserializable.php
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Get the value of first_name
     */ 
    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     *
     * @return  self
     */ 
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */ 
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */ 
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        $user_id = $this->_id;
        $timestamp = $user_id->getTimestamp();
        $date = (new DateTime())->setTimestamp($timestamp);
        return $date->format("d/m/Y H:i:s");
    }

    




    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of admin
     */ 
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the value of admin
     *
     * @return  self
     */ 
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    public function isValid()
    {
        // 1 il a bien rempli tous les champs


        // 2 l'adresse mail n'existe pas dans notre BDD

       
        // permet de valider le contenu récupérer du formulaire


        // son retour est boolean
        return true;
    }


    public function save()
    {
        $cnx = new Connexion();

        $cnx->addToDb("user", $this);
       
    }



    public static function getUserByEmail($email)
    {
        $cnx = new Connexion();

        //$user = $cnx->getOne("SELECT * FROM user WHERE email = ?", [$email], "User");
        $userBson = $cnx->findOne(["email" => $email], "user");       

        // converti l'objet de type "document bson" en string
        $user_string = MongoDB\BSON\fromPHP($userBson);

        // converti l'objet bson serialiser en object  ( ici "Product")
        // la fonction  bsonUnserialize est appellé a ce moment là
        $user = MongoDB\BSON\toPHP($user_string, ['root' => "User"]);


        return $user;
    }


    public static function getUserById($id)
    {

       
        $cnx = new Connexion();

        // $user = $cnx->getOne("SELECT * FROM user WHERE id = ?", [$id], "User");


        //$user = $cnx->getOne("SELECT * FROM user WHERE email = ?", [$email], "User");
        $userBson = $cnx->findOne(["_id" => new MongoDB\BSON\ObjectId($id)], "user");

        // converti l'objet de type "document bson" en string
        $user_string = MongoDB\BSON\fromPHP($userBson);

        // converti l'objet bson serialiser en object  ( ici "Product")
        $user = MongoDB\BSON\toPHP($user_string, ['root' => "User"]);

        return $user;
    }
}

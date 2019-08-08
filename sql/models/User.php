<?php



class User
{ 

    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $createdAt;
    private $password;
    private $admin;



    // public function __construct($first_name, $last_name, $email, $password, $admin = 0)
    // {
    //     $this->firstName = $first_name;
    //     $this->lastName = $last_name;
    //     $this->email = $email;
    //     $this->createdAt = date("Y-m-d H:i:s");
    //     $this->password = password_hash($password, PASSWORD_BCRYPT);
    //     $this->admin = $admin;
    // }
    
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }


    
    /**
     * Get the value of firstName
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */ 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }



    /**
     * Get the value of lastName
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */ 
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

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
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
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
    return true;
}


    public function save()
    {
        $cnx = new Connexion();


        // méthode d'insertion dans la base de données
        $cnx->querySQL("INSERT INTO user (firstname, lastName, email, created_at, password, admin) VALUES (?,?,?,?,?,?)", [
            $this->firstName,
            $this->lastName,
            $this->email,
            date("Y-m-d H:i:s"),
            // $this->createdAt,
            password_hash($this->password, PASSWORD_BCRYPT),
            $this->admin
        ]);
    }


    // méthode pour la récupération d'un seul utilisateur
    public function getUserById($id)
    {
        $cnx = new Connexion();
        // renvoie le nom de la classe ou a été définie la fonction
        $user = $cnx->getOne("SELECT * FROM user WHERE id=?", [$id], get_class($this));

        return $user;
    }



    // méthode de récupération de tous les utilisateurs
    public static function getAllUsers()
    {
        $cnx = new Connexion();
        $users = $cnx->getMany("SELECT * FROM user", get_class($this));

        return $users;
    }


    public static function getUserByEmail($email)
    {
        $cnx = new Connexion();

        $user = $cnx->getOne("SELECT * FROM user WHERE email = ?", [$email], "User");

        return $user;
    }



}

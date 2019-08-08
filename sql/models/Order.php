<?php


class Order
{ 

    private $id;
    private $createdAt;
    private $submittedAt;
    private $totalHt;
    private $totalTtc;
    private $userId;



    // public function __construct($total_ht, $total_ttc, $user_id)
    // {
    //     $this->totalHt = $total_ht;
    //     $this->totalTtc = $total_ttc;
    //     $this->user_id = $user_id;
    //     $this->createdAt = date("Y-m-d H:i:s");
    //     // (new DateTime("now"))->format("Y-m-d H:i:s")
    // }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

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
     * Get the value of sublittesAt
     */ 
    public function getSubmittedAt()
    {
        return $this->sublittesAt;
    }

    /**
     * Set the value of sublittesAt
     *
     * @return  self
     */ 
    public function setSubmittedAt($sublittesAt)
    {
        $this->sublittesAt = $sublittesAt;

        return $this;
    }

    /**
     * Get the value of totalHt
     */ 
    public function getTotalHt()
    {
        return $this->totalHt;
    }

    /**
     * Set the value of totalHt
     *
     * @return  self
     */ 
    public function setTotalHt($totalHt)
    {
        $this->totalHt = $totalHt;

        return $this;
    }

    /**
     * Get the value of totalTtc
     */ 
    public function getTotalTtc()
    {
        return $this->totalTtc;
    }

    /**
     * Set the value of totalTtc
     *
     * @return  self
     */ 
    public function setTotalTtc($totalTtc)
    {
        $this->totalTtc = $totalTtc;

        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }



    public function save()
    {
        $cnx = new Connexion();


       $id = $cnx->querySQL("INSERT INTO order (created_at,total_ht, total_ttc, user_id) VALUES (?,?,?,?)", [
            date("Y-m-d H:i:s"),
            //$this->createdAt,
            //$this->submittedAt,
            $this->totalHt,
            $this->totalTtc,
            $this->userId
        ]);

        return $id;

    }


    public static function editSubmittedAt($id)
    {
        $cnx = new Connexion();
        $cnx->querySQL(
            "UPDATE order SET submitted_at = ? WHERE id = ?",
            [
                date("Y-m-d H:i:s"),
                $id
            ]
        );
    }





    // méthode pour la récupération d'un seul order


    // méthode de récupération d'une seule commande AVEC ses orderDetails 

    public static function getOrderById($id)
    {
        $cnx = new Connexion();
        $order = $cnx->getOne(
            "SELECT * FROM order WHERE id = ?",
            [$id],
            "Order"
        );

        return $order;
    }


    public static function getOrderByUserId($id)
    {
        $cnx = new Connexion();
        $order = $cnx->getOne(
            "SELECT * FROM order WHERE user_id = ?",
            [$id],
            "Order"
        );

        return $order;
    }
    // public function getOrderById($id)
    // {
    //     $cnx = new Connexion();
    //     // renvoie le nom de la classe ou a été définie la fonction
    //     $order = $cnx->getOne("SELECT * FROM order AS o INNER JOIN order_detail AS od ON o.id=od.order_id WHERE o.id=?",[$id] get_class($this));

    //     return $order;
    // }



    public function getAllOrders($id)
    {
        // A changer et utilser la jointure pour récupérer les détails des commandes
        $cnx = new Connexion();
        return $cnx->getMany(
            "SELECT * FROM order INNER JOIN order_detail ON order.id = order_detail.oreder_id WHERE id=?",
            "Order", [$id]
        );
    }


}

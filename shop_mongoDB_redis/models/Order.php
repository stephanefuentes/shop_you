<?php


class Order implements MongoDB\BSON\Serializable, MongoDB\BSON\Unserializable
{
    // proprietés
    private $_id;
    //private $created_at;
    private $submitted_at;
    private $total_ht;
    private $total_ttc;
    private $user_id;
    private $order_detail;


    public function bsonSerialize()
    {

        return [
            //'id' => $this->id,
            //'created_at' => new \MongoDB\BSON\UTCDateTime(new DateTime()),
            'submitted_at' => $this->submitted_at, //  ou NULL, c'est pareil
            'total_ht' => (float) $this->total_ht,
            'total_ttc' => (float) $this->total_ttc,
            'user_id' => $this->user_id,
            'order_detail' => $this->order_detail


        ];
    }


    // va récuperer automatiquement les doonnées de l'attribut storage ( qui est un tableau) dans l'objet de type document bson
    public function bsonUnserialize(array $data)
    {
        foreach ($data as $key => $value) {
           
            if($key == "order_detail")
            {

                // PAR DEFAULT UN OBBJET PHP NON DEFINIT EST DE TYPE STD CLASS
                //  ( ici $order_detail), et ses propriètées sont publics 
                foreach($data["order_detail"] as $order_detail)
                {
                    $od = new OrderDetails();
                    $od->set_id($order_detail->_id);
                    $od->setQuantity_ordered($order_detail->quantity_ordered);
                    $od->setPrice_each($order_detail->price_each);
                    $od->setTotal_price($order_detail->total_price);
                    $od->setProduct_id($order_detail->product_id);
                    $this->order_detail[]= $od;
                }
            }
            else{


                $this->$key = $value;
            }
            
        }

        //$this->unserialized = true;

        //https://www.php.net/manual/fr/mongodb.persistence.deserialization.php#mongodb.persistence.typemaps

        //https://www.php.net/manual/fr/class.mongodb-bson-unserializable.php
    }


    // getter et setter

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->_id;
    }


    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        //return $this->created_at;
        
        // l'objet _id du document permet de récupérer la date de création du document de la façon suivante .... du coup , il n'est pas forcément nécessaire de créer la propriété $created_at dans la classe
        $id_object = $this->_id;
        $timestamp = $id_object->getTimestamp();
        $date = new DateTime();
        $date->setTimestamp($timestamp);
        return $date->format('d/m/Y H:i:s');
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of submitted_at
     */
    public function getSubmitted_at()
    {
        if($this->submitted_at != null)
        return ($this->submitted_at)->toDateTime();
    }

    /**
     * Set the value of submitted_at
     *
     * @return  self
     */
    public function setSubmitted_at($submitted_at)
    {
        $this->submitted_at = $submitted_at;

        return $this;
    }



    /**
     * Get the value of user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of total_ht
     */
    public function getTotal_ht()
    {
        return $this->total_ht;
    }

    /**
     * Set the value of total_ht
     *
     * @return  self
     */
    public function setTotal_ht($total_ht)
    {
        $this->total_ht = $total_ht;

        return $this;
    }

    /**
     * Get the value of total_ttc
     */
    public function getTotal_ttc()
    {
        return $this->total_ttc;
    }

    /**
     * Set the value of total_ttc
     *
     * @return  self
     */
    public function setTotal_ttc($total_ttc)
    {
        $this->total_ttc = $total_ttc;

        return $this;
    }


    /**
     * Get the value of order_detail
     */
    public function getorder_detail()
    {
        return $this->order_detail;
    }

    /**
     * Set the value of order_detail
     *
     * @return  self
     */
    public function setorder_detail($order_detail)
    {
        $this->order_detail = $order_detail;

        return $this;
    }




    // méthode d'insertion dans la base de données
    public function save()
    {
        $cnx = new Connexion();
        // $id =  $cnx->querySQL(
        //     "INSERT INTO `order` (created_at, total_ht, total_ttc, user_id) VALUES (?,?,?,?)",
        //     [
        //         date('Y-m-d H:i:s'),
        //         $this->total_ht,
        //         $this->total_ttc,
        //         $this->user_id
        //     ]
        // );

        // return $id;


        $id = $cnx->addToDb("order", $this);
        return $id;
    }


    
    public static function editSubmittedAt($id)
    {
        $cnx = new Connexion();
        // $cnx->querySQL(
        //     "UPDATE `order` SET submitted_at = ? WHERE id = ?",
        //     [
        //         date("Y-m-d H:i:s"),
        //         $id
        //     ]
        // );
        $cnx->update(
            'order',
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['submitted_at' => new MongoDB\BSON\UTCDateTime()]
        );


    }

    // méthode de récupération d'une seule commande AVEC ses od 

    public static function getOrderById($id)
    {
        $cnx = new Connexion();
        // $stmt = ($cnx->getPdo())->prepare("SELECT `order`.*, od.* FROM `order` JOIN od ON `order`.id = od.order_id WHERE `order`.id=?");
        // $stmt->execute([$id]);
        // $order = $stmt->fetchAll();

        
        $orderBson = $cnx->findOne(["_id" => new MongoDB\BSON\ObjectId($id)], "order");

        // converti l'objet de type "document bson" en string
        $order_string = MongoDB\BSON\fromPHP($orderBson);

        // converti l'objet bson serialiser en object  ( ici "order")
        // la fonction  bsonUnserialize est appellé a ce moment là
        $order = MongoDB\BSON\toPHP($order_string, ['root' => "Order"]);


        return $order;
    }

    public static function getOrderByUserId($id)
    {
        $cnx = new Connexion();
        // $orders = $cnx->getMany(
        //     "SELECT * FROM `order` WHERE user_id = ?",
        //     "Order",
        //     [$id]
        // );

        //$orderBson = $cnx->findOne(["user_id" => $id], "order");

        $ordersBson = $cnx->findMany("order", ["user_id" => $id]);

        foreach($ordersBson as $orderBson)
        {


            // converti l'objet de type "document bson" en string
            $order_string = MongoDB\BSON\fromPHP($orderBson);
    
            // converti l'objet bson serialiser en object  ( ici "Product")
            $order = MongoDB\BSON\toPHP($order_string, ['root' => "Order"]);

            $orders[] = $order;

        }


        return $orders;
    }


    public function getAllOrders()
    {
        // A changer et utilser la jointure pour récupérer les détails des commandes
        $cnx = new Connexion();
        // return $cnx->getMany(
        //     "SELECT * FROM `order`",
        //     "Order"
        // );


        // $productsBson représente un tableau d'objet de type "document bson"
        $ordersBson = $cnx->find("order");

        foreach ($ordersBson as $orderBson) {
            // converti l'objet de type "document bson" en string
            $order_string = MongoDB\BSON\fromPHP($orderBson);

            // converti l'objet bson serialiser en object  ( ici "Product")
            $order = MongoDB\BSON\toPHP($order_string, ['root' => "Order"]);

            $order[] = $order;
        }

        return $order;

    }


   

  
}

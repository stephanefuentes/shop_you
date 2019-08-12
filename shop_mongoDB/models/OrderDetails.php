<?php


class OrderDetails implements MongoDB\BSON\Serializable, MongoDB\BSON\Unserializable
{
    // proprietés
    private $_id;
    private $quantity_ordered;
    private $price_each;
    private $total_price;
    //private $order_id;
    private $product_id;



    public function bsonSerialize()
    {

        return [
            //'id' => $this->id,

            // ne sera paqs généré automatiquement car cil ne sra pas référencé comme une collection dans notre base mongo en fait, 
            '_id' => new MongoDB\BSON\ObjectId(),
            'quantity_ordered' => (int) $this->quantity_ordered,
            'price_each' => (float) $this->price_each,
            'total_price' => (float) $this->total_price,
            //'order_id' => $this->order_id,
            'product_id' => $this->product_id


        ];
    }


    // va récuperer automatiquement les doonnées de l'attribut storage ( qui est un tableau) dans l'objet de type document bson
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
     * Set the value of _id
     *
     * @return  self
     */
    public function set_id($_id)
    {
        $this->_id = $_id;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Get the value of quantity_ordered
     */ 
    public function getQuantity_ordered()
    {
        return $this->quantity_ordered;
    }

    /**
     * Set the value of quantity_ordered
     *
     * @return  self
     */ 
    public function setQuantity_ordered($quantity_ordered)
    {
        $this->quantity_ordered = $quantity_ordered;

        return $this;
    }

    /**
     * Get the value of price_each
     */ 
    public function getPrice_each()
    {
        return $this->price_each;
    }

    /**
     * Set the value of price_each
     *
     * @return  self
     */ 
    public function setPrice_each($price_each)
    {
        $this->price_each = $price_each;

        return $this;
    }

    /**
     * Get the value of total_price
     */ 
    public function getTotal_price()
    {
        return $this->total_price;
    }

    /**
     * Set the value of total_price
     *
     * @return  self
     */ 
    public function setTotal_price($total_price)
    {
        $this->total_price = $total_price;

        return $this;
    }

   

    /**
     * Get the value of product_id
     */ 
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */ 
    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }




    // méthode d'insertion dans la base de données

    public function save()
    {
        $cnx = new Connexion();
        // $cnx->querySQL(
        //     "INSERT INTO order_details (quantity_ordered, price_each, total_price, order_id, product_id) VALUES (?,?,?,?,?)",
        //     [
        //         $this->quantity_ordered,
        //         $this->price_each,
        //         $this->total_price,
        //         $this->order_id,
        //         $this->product_id
        //     ]
        //     );


        $cnx->addToDb("order_detail", $this);

    }

    public static function getOrderDetailsByOrder($id)
    {
        $cnx = new Connexion();
        $result = $cnx->getMany(
                    "SELECT * FROM order_details WHERE order_id = ?",
                    'OrderDetails',
                    [$id]
                ); 
        return $result;
    }

    
}
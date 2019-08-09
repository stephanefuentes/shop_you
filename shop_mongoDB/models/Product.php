<?php



class Product implements MongoDB\BSON\Serializable, MongoDB\BSON\Unserializable
{
    private $_id;
    private $name;
    private $description;
    private $price;
    private $quantity;
    private $picture_url;


    public function bsonSerialize()
    {
        
        return [
            //'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => (float) $this->price,
            'quantity' => (int) $this->quantity,
            'picture_url' => $this->picture_url,
            
            
        ];

        
    }


    public function bsonUnserialize(array $data)
    {
        foreach( $data as $key => $value)
        {
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
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
    /**
     * Get the value of picture_url
     */ 
    public function getPicture_url()
    {
        return $this->picture_url;
    }

    /**
     * Set the value of picture_url
     *
     * @return  self
     */ 
    public function setPicture_url($picture_url)
    {
        $this->picture_url = $picture_url;

        return $this;
    }
    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

 

    public function isValid()
    {
        
        return true;
    }


    public function save()
    {
        $cnx = new Connexion();
        $cnx->addToDb("product",$this);
            
       
    }


    // méthode pour la récupération d'un seul produit

    public static function getProductById($id)
    {
        $cnx = new Connexion();

        //$product = $cnx->getOne("SELECT * FROM product WHERE id=?", [$id], 'Product');

        // retourne une objet de type "document bson"
        $productBson = $cnx->findOne(['_id' => new MongoDB\BSON\ObjectId($id)], "product");

        // converti l'objet de type "document bson" en string
        $product_string = MongoDB\BSON\fromPHP($productBson);

        // converti l'objet bson serialiser en object  ( ici "Product")
        $product = MongoDB\BSON\toPHP($product_string, ['root' => "Product"]);

        //dd($product);

       return $product;
    }


    // méthode pour la récupération de la liste de tous les produits
    public static function getAllProducts()
    {
        $cnx = new Connexion();
       // $products = $cnx->getMany("SELECT * FROM product", "Product");

       // $productsBson représente un tableau d'objet de type "document bson"
       $productsBson = $cnx->find("product");

       foreach($productsBson as $productBson)
       {
            // converti l'objet de type "document bson" en string
            $product_string = MongoDB\BSON\fromPHP($productBson);

            // converti l'objet bson serialiser en object  ( ici "Product")
            $product = MongoDB\BSON\toPHP($product_string, ['root' => "Product"]);

            $products[] = $product;
       }

        return $products;
    }



    public function update()
    {
        $cnx = new Connexion();
        $cnx->querySQL(
            "UPDATE  product SET name= ?, description=?, price=?, quantity=?, picture_url=? WHERE id=?",
            [
                $this->name,
                $this->description,
                $this->price,
                $this->quantity,
                $this->picture_url,
                $this->id
            ]
            );
            
       
    }



}
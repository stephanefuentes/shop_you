<?php



class Product
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $quantity;
    private $picture_url;

    
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
        $cnx->querySQL(
            "INSERT INTO product (name, description, price, quantity, picture_url) VALUES (?,?,?,?,?)",
            [
                $this->name,
                $this->description,
                $this->price,
                $this->quantity,
                $this->picture_url
            ]
            );
            
       
    }


    // méthode pour la récupération d'un seul produit

    public static function getProductById($id)
    {
        $cnx = new Connexion();
        
        $product = $cnx->getOne("SELECT * FROM product WHERE id=?", [$id], 'Product');

        return $product;
    }

    // méthode pour la récupération de la liste de tous les produits

    public static function getAllProducts()
    {
        $cnx = new Connexion();
        $products = $cnx->getMany("SELECT * FROM product", "Product");

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
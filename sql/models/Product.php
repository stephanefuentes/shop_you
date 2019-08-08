<?php

//require "utilities/Connexion.php";

class Product
{
        private $id;
        private $name;
        private $description;
        private $price;
        private $quantity;
        private $picture;

        // public function __construct($name, $description, $price, $quantity, $picture)
        // {
        //         $this->name = $name;
        //         $this->description = $description;
        //         $this->price = $price;
        //         $this->quantity = $quantity;
        //         $this->picture = $picture;
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

        /**
         * Get the value of picture
         */
        public function getPicture()
        {
                return $this->picture;
        }

        /**
         * Set the value of picture
         *
         * @return  self
         */
        public function setPicture($picture)
        {
                $this->picture = $picture;

                return $this;
        }

        public function isValid()
        { }



        public function save()
        {
               $cnx = new Connexion();


               $cnx->querySQL("INSERT INTO product (name, description, price, quantity, picture_url) VALUES (?,?,?,?,?)", [
                        $this->name,
                        $this->description,
                        $this->price,
                        $this->quantity,
                        $this->picture
                ]);
               


                // $stmt = $cnx->prepare("INSERT INTO product (name, description, price, quantity, picture_url) VALUES (?,?,?,?,?)");
                // $stmt->execute([
                //         $this->name,
                //         $this->description,
                //         $this->price,
                //         $this->quantity,
                //         $this->picture
                // ]);
        }



          // méthode pour la récupération d'un seul produit
        public static function getProductById($id)
        {
                $cnx = new Connexion();
                                                                        // renvoie le nom de la classe ou a été définie la fonction
                $product = $cnx->getOne("SELECT * FROM products WHERE id=?", [$id], get_class($this));

                return $product;
        }


        // méthode pour la récupération de la liste de tous les produits

        public static function getAllProducts()
        {
                $cnx = new Connexion();
                $products = $cnx->getMany("SELECT * FROM products", "Product");

                return $products;
        }

      


     

}

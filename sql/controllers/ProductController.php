<?php

//require "models/Product.php";

class ProductController
{

    // sert à afficher la liste des produits
    // monsite.fr/product ou monsite.fr/product/index
    public function index()
    { 

        $products = Product::getAllProducts();
        require 'views/user/list_product.php';

    }


    // monsite.fr/product/show/12
    public function show($id)
    {
        $product = Product::getProductById($id);

        require "views/user/show_product.php";
    }




    public function add()
    {
        //récupération des données du formulaire
        // http://monsite.fr/image1.jpg
        if (isset($_POST['name'])) {
            $produit = new Product($_POST['name'], $_POST['description'], $_POST['price'], $_POST['quantity'], $_POST['picture']);
            if ($produit->isValid()) {
                $produit->save();
            } else { }
        }
    }
}

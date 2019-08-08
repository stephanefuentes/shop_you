<?php


class AdminController extends Controller
{
    public function __construct()
    {
        $this->isAdminConnected();
    }
    // dashboard pour l'administrateur
    // accessible en utilisant soit: monsite.fr/admin ou monsitefr/admin/index
    public function index()
    {
        require "views/admin/index.php";
    }

    public function listproducts()
    {


        $products = Product::getAllProducts();

        require 'views/admin/list_product.php';
    }


    public function ajouterproduct()
    {
        if (isset($_POST['submit'])) {
            $product = new Product();
            $product->setName($_POST['name']);
            $product->setDescription($_POST['description']);
            $product->setPrice($_POST['price']);
            $product->setQuantity($_POST['quantity']);
            $product->setPicture($_POST['picture']);
            if ($product->isValid()) {
                $product->save();
                $this->redirectTo('/admin/listproducts');
            }
        }


        require "views/admin/add_product.php";
    }



    public function showusers()
    {
        $users = User::getAllUsers();

        require "views/admin/list_users.php";
    }


    public function addadmin()
    {
        if (array_key_exists('submit', $_POST)) {
            $user = new User();
            $user->setFirst_name(($_POST['firstName']));
            //....
            $user->setAdmin(true);
            if ($user->isValid()) {
                $user->save();
                $this->redirectTo('/admin/showusers');
            }
        }

        require "views/admin/add_admin.php";
    }

    
    public function setOrderDelivered($id)
    {
        Order::editSubmittedAt($id);
        $this->redirectTo('/admin/listproducts');
    }



}

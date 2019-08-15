<?php



class ProductController extends Controller
{
    // sert à afficher la liste des produits
    // monsite.fr/product ou monsite.fr/product/index
    public function index()
    {
        $products = Product::getAllProducts();
        
        require 'views/product/list_product.php';
    }


    // monsite.fr/product/show/12
    public function show($id)
    {
        $product = Product::getProductById($id);
        
        require "views/product/show_product.php";
    }

    
    public function cart()
    {

        require "views/product/cart.php";
    }


// index.php/product/cart_ajax
    public function cart_ajax()
    {
        $session = new Session();

         if(!isset($_SESSION['cart']))
        {
            $_SESSION['cart'] = [];
        }

        $exit = false;
        foreach ($_SESSION['cart'] as $key => $cart) 
        {
        //    dump("key : " +$key);
        //    dump("cart : "+ $cart );

            if ($cart['product_id'] == $_POST['product_id'])
             {
                $_SESSION['cart'][$key]['product_quantity'] += $_POST['product_quantity'];
                $exit = true;
            }
        }

        if ($exit == false)
        {
            //array_push( $_SESSION["cart"], $_POST);
             $_SESSION['cart'][] = $_POST;

        }

        echo json_encode($_SESSION['cart']);
        //dump($_SESSION);
    }




    public function clear_cart()
    {
        $session = new Session();
        $_SESSION['cart'] = [];
        $this->redirectTo('/product/cart');
    }


}
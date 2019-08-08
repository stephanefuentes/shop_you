


<?php


if(isset($_COOKIE['cart']))
{
    $products = explode("|", $_COOKIE['cart']);

    foreach($products as $product)
    {
        $tab = explode(',',$product);
        var_dump($tab[0]);
    }
}
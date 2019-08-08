<?php include('header.php'); ?>


<h1>Produit</h1>



<h2><?= $product->getName(); ?></h2>
<p><?= $product->getPicture(); ?></p>
<p><?= $product->getDescription(); ?></p>
<p><?= $product->getPrice(); ?></p>
<p><?= $product->getquantity(); ?></p>




<?php include('footer.php'); ?>
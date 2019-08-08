<?php include('views/header.php'); ?>


<h1 class="text-center m-5">Liste des produits</h1>



<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Descritpion</th>
            <th scope="col">Price</th>
            <!-- <th scope="col">Column heading</th> -->
        </tr>
    </thead>
    <tbody>

<?php foreach ($products as $product) : ?>


        <tr class="table-secondary">
            <!-- <th scope="row">Secondary</th> -->
            <td><?= $product->getName(); ?></td>
            <td><?= $product->getDescription(); ?></td>
            <td><?= $product->getPrice(); ?></td>
        </tr>

<?php endforeach ?>
    </tbody>
</table>




<?php include('views/footer.php'); ?>
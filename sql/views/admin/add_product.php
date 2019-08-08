<?php include('../header.php'); ?>


<h1>Edition d'un produit</h1>


<?php if ($error) : ?>
    <span> <?= $error ?> </span>
<?php endif ?>


<form action="" method="post">
    <fieldset>
        <legend>Edition d'un produit</legend>

        <!-- <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="email@example.com">
            </div>
        </div> -->

        <div class="form-group">
            <label for="name">nom du produit</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="nom du produit ..">
        </div>


        <div class="form-group">
            <label for="description">Desciption</label>
            <textarea class="form-control" id="description" name="description" placeholder="Description du produit ...." rows="10"></textarea>
        </div>


        <div class="form-group">
            <label for="price">Prix du produit</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Prix du produit ..">
        </div>


        <div class="form-group">
            <label for="quantity">quantité en stock</label>
            <input type="number" class="form-control" id="quantity" name="quantity" min="10" max="10000">
        </div>


        <div class="form-group">
            <label for="picture">Picture</label>
            <input type="text" class="form-control" id="picture" name="picture" placeholder="url de l'image du produit ...">
        </div>


        <button type="submit" name="valider" class="btn btn-primary">Submit</button>
    </fieldset>
</form>


<?php include('../footer.php'); ?>
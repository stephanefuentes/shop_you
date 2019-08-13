<div>
    <a href="<?= REQUEST_URL ?>/product/cart">Afficher le panier</a>
</div>
<div>

    <?php foreach ($products as $product) : ?>

    <?php if ($product->getQuantity() > 0) : ?>
    <div class="product" id="<?= $product->getId() ?>">
        <a class="product_name" href="<?= REQUEST_URL ?>/product/show/<?= $product->getId() ?>">
            <h2><?= $product->getName() ?></h2>
        </a> <br>
        <img src="<?= $product->getPicture_url() ?>" alt="">
        <p class="product_description"><?= $product->getDescription() ?></p><br>
        <span class="product_price"><?= $product->getPrice() ?></span><br>
        <select class="quantity">
            <?php for ($i = 1; $i <= $product->getQuantity(); $i++) : ?>
            <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor ?>
        </select><br>

        <button class="add_to_cart">Ajouter au panier</button><br>
    </div>
    <?php endif ?>

    <?php endforeach ?>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="<?= ASSETS ?>js/cart.js"></script>
<script>
    cart_management();
</script>
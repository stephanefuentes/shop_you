<?php include('views/header.php'); ?>


<h1>Historique des commandes</h1>

<?php foreach ($orders as $order) : ?>

    <span><?= $order->getId() ?></span>
    <p><?= $order->getCreated_at() ?></p>
    <p> <?php if ($order->getSubmittedAt() == null) : ?>
            La commande n'est pas encore expédiée
        <?php else :  ?>
            la commande a été expédiée le <?= $order->getSubmittedAt() ?>
        <?php endif ?>
    </p>
    <p>Prix TTC => <?= $order->getPrice_ttc() ?></p>

<?php endforeach ?>



<?php include('views/footer.php'); ?>
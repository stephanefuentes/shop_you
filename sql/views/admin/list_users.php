<?php include('views/header.php'); ?>


<h1>Liste des utilisateurs ( dashboard admin )</h1>


<?php foreach ($users as $user) : ?>

    <p><?= $user->getFirst_name() ?></p>
    ....

<?php endforeach ?>


<?php include('views/footer.php'); ?>
<div>
    <h1>Commande</h1><br>
    <!-- Identifiant : <p><?php //echo $order[0][0]; 
                            ?></p><br> -->

    Identifiant : <p><?= $order->getId() ?></p><br>
    <!-- Commandé le : <p><?php //echo $order[0]['created_at']; 
                            ?></p><br> -->

    Commandé le : <p><?= $order->getCreated_at() ?></p><br>

    <!-- Total HT : <p><?php //echo $order[0]['total_ht']; 
                        ?></p><br> -->
    Total HT : <p><?php echo $order->getTotal_ht(); ?></p><br>
    <!-- Total TTC : <p><?php //echo $order[0]['total_ttc'] 
                        ?></p><br> -->
    Total TTC : <p><?php echo $order->getTotal_ttc(); ?></p><br>

</div>

<div>
    <table>
        <tr>
            <th>Quantité Commandé</th>
            <th>prix unitaire</th>
            <th>Total</th>
            <th>Produit commandé</th>
        </tr>

        <?php foreach ($order->getOrder_detail() as $o) : ?>
            <tr>
                <!-- <td><?php //echo $o['quantity_ordered'] ?></td> -->
                <td><?= $o->getQuantity_ordered() ?></td>

                <!-- <td><?php //echo $o['price_each'] ?></td> -->
                <td><?= $o->getPrice_each() ?></td>

                <!-- <td><?php //echo $o['total_price'] ?></td> -->
                <td><?= $o->getTotal_price() ?></td>

                <td><a href="<?= REQUEST_URL ?>/product/show/<?= $o->getProduct_id() ?>">Afficher le produit</a></td>
            </tr>
        <?php endforeach ?>
    </table>

</div>
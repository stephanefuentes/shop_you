<?php
try{
$bdd = new PDO('mysql:host=localhost;dbname=boutique;', 'root', 'troiswa');
 $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// mode de fetch par défaut : FETCH_ASSOC / FETCH_OBJ / FETCH_BOTH
 $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
var_dump($bdd);

$query = "CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `submitted_at` datetime NOT NULL,
  `total_ht` decimal(10,0) NOT NULL,
  `total_ttc` decimal(10,0) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$bdd->query($query);

$query = "CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `quantity_ordered` int(11) NOT NULL,
  `price_each` decimal(10,0) NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$bdd->query($query);



$query = "CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$bdd->query($query);



$query = "CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$bdd->query($query);



$query = "ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`)";

$bdd->query($query);



$query = "ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `order_details_ibfk_1` (`product_id`)";

$bdd->query($query);



$query = "ALTER TABLE `products`
  ADD PRIMARY KEY (`id`)";

$bdd->query($query);


$query = "ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);";

$bdd->query($query);



//AUTO_INCREMENT pour les tables déchargées

$query = "ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
$bdd->query($query);

$query = "ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$bdd->query($query);

$query = "ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$bdd->query($query);

$query = "ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
$bdd->query($query);



// ------------------------------------------- Contraintes
$query = "ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION";
$bdd->query($query);



$query = "ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT";
$bdd->query($query);


//  on ferme la base de donnée
//$bdd = null;

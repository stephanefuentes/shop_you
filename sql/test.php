<?php

var_dump($_COOKIE);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <div>
        <button class="clear_cart" onclick="deleteCart()">Vider le panier</button>
    </div>
    <hr>
    <div class="product" id="1">
        <p class="product_name">produit 1 </p> <br>
        <p class="product_description">Description produit 1 </p><br>
        <span class="product_price">10</span><br>
        <input type="number" class="quantity" id="">
        <button class="add_to_cart">Ajouter au panier</button><br>
    </div>
    <hr>
    <div class="product" id="2">
        <p class="product_name">produit 2 </p><br>
        <p class="product_description">Description produit 2 </p><br>
        <span class="product_price">20</span><br>
        <input type="number" class="quantity" id="">
        <button class="add_to_cart">Ajouter au panier</button><br>
    </div>
    <hr>
    <div class="product" id="3">
        <p class="product_name">produit 3 </p><br>
        <p class="product_description">Description produit 3 </p><br>
        <span class="product_price">30</span><br>
        <input type="number" class="quantity" id="">
        <button class="add_to_cart">Ajouter au panier</button><br>
    </div>


    <div id="show_cart"></div>
    <div id="total"></div>
    <a href="test2.php">Valider Commande</a>


    <script>
        var products = [450, "toto", 55, 20]
        var buttons = document.querySelectorAll(".add_to_cart");

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                var div = this.parentNode
                // récupérer l'id de la classe product
                var id = div.getAttribute('id')

                // récupérer product name
                //var name = div.getElementsByClassName('product_name')[0].textContent
                //var name = div.childNodes[1].textContent
                var name = div.querySelector('p.product_name').textContent


                // récupérer le prix
                //var price = div.childNodes[8].textContent
                var price = div.getElementsByClassName('product_price')[0].textContent

                var quantity = div.getElementsByClassName('quantity')[0].value




                var content = getCookiesContent('cart');
                if (content == null) {
                    setCookie('cart', id + ',' + name + ',' + price + ',' + quantity, 4);

                } else {
                    // ancien contenu récupéré => '14,produit 14,5,40|2,produit2,1,10'
                    // // convertir en tableau 
                    var products = content.split('|');

                    console.log('products = ', products)

                    var exist = false;
                    for (var i = 0; i < products.length; i++) {
                        var simple_product = products[i].split(',');

                        if (simple_product[0] == id) {

                            simple_product[3] = parseInt(simple_product[3]) + parseInt(quantity);
                            products[i] = simple_product;
                            exist = true
                        }
                    }
                    if (exist) {
                        setCookie("cart", products.join('|'), 4);
                    } else {
                        content += '|' + id + ',' + name + ',' + price + ',' + quantity;
                        // nouveau contenu => '14,produit 14,5,40|2,produit2,1,10|6,produit 6,20,1'
                        setCookie("cart", content, 4);
                    }
                }
                show_cart();
            })
        })

        // syntaxe pour les cookies, la date d'expiration est OPTIONNELLE -> quand leNAVIGATEUR se FERME, les cookies disparraissent
        // document.cookie = "nom=valeur Qu'on veut stocker; expires=Thu , 5 Aug 2019 15:20:30 UTC; path=/"


        //ajouter des event listener sur les boutons qui sont à coté de chaque produit 

        // en cliquant sur chaque bouton il va stocker les données du produit dans les cookies 


        // permet d'afficher les produits dans la page du panier
        // document.cookie = "nom=valeur Qu'on veut stocker; expire=Thu , 29 Aug 2019 15:20:30 UTC; path=/"

        // var $tab = document.cookie.split(';')
        // console.log($tab);
        // $tab[0] il va contenir ==> nom=valeur Qu'on veut stocker,
        // la valeur qu'on veut stocker va ressembler à ça:id_product + nom + qte + prix

        // il faut enlever la chaine de caractère "nom="

        //1,chaussure,1,19-4,pantalon,2,29
        // split("-")
        // let steph = []

        // document.cookie = "nom=valeur Qu'on veut stocker; expire=Thu , 29 Aug 2019 15:20:30 UTC; path=/"





        //id_product + nom + qte + prix  

        function setCookie(nom, valeur, nbre_jours) {
            var date = new Date()
            date.setTime(date.getTime() + (nbre_jours * 24 * 60 * 60 * 1000))
            document.cookie = nom + "=" + valeur + "; expire=" + date.toGMTString() + "UTC; path=/";
        }

        //setCookie("cart", "4 chaussure 1 19", 4)

        //id_product + nom + qte + prix  
        function deleteCart() {
            document.cookie = "cart= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
            document.cookie = "nom= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
        }


        function show_cart() {
            var content = getCookiesContent('cart')
            var emplacement = document.querySelector("#show_cart");
            var emplacement_total = document.querySelector("#total");
            if (content == null) {
                emplacement.innerHTML = "<span> Votre panier est vide </span>";
            } else {
                var products = content.split('|');
                var html_content = '';
                var total = 0;
                for (var i = 0; i < products.length; i++) {
                    var product = products[i].split(",")
                    total += parseFloat(product[2]) * parseFloat(product[3])
                    html_content += "<div><h3> Nom du produit: " + product[1] + "</h3><br><span>Prix unitaire" + product[2] +
                        "</span><br><span> Quantité: " + product[3] + "</span><br><span> Prix total: " + (parseFloat(product[2]) * parseFloat(product[3])) + "€</span></div>"
                }
                emplacement.innerHTML = html_content;
                emplacement_total.innerHTML = "<h1> Montant Total TTC: " + total + " €</h1>"
            }
        }


        function getCookiesContent(name) {

            var cookies_content = document.cookie.split(";");
            console.log("cookies_content = " + cookies_content)
            for (var i = 0; i < cookies_content.length; i++) {

                if (cookies_content[i].substring(0, name.length) == name) {

                    content = cookies_content[i].replace(name + "=", '');
                    console.log("content = " + content)
                    return content;

                }
            }
            return null;
        }



        // let cookieDinger = document.cookie.split(';')
        // console.log(cookieDinger)
    </script>
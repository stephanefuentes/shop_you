function cart_management() {
    var buttons = document.querySelectorAll(".add_to_cart");

    buttons.forEach(function (button) {
        button.addEventListener('click', function () {

            var div = this.parentNode

            // // récupérer l'id de la classe product
            var id = div.getAttribute('id');
            var children = div.childNodes;

            for (var i = 0; i < children.length; i++) {
                if (children[i].className == "product_name") {
                    // // récupérer product name
                    var name = children[i].innerText;
                }
                if (children[i].className == "product_price") {
                    // // récupérer le prix
                    var price = children[i].textContent;
                }
                if (children[i].className == "quantity") {
                    // // récupérer le prix
                    var quantity = children[i].value;
                }
            }


            $.ajax({
                url: "index.php/product/cart_ajax",
                type: "POST",
                data: { product_id: id, product_name: name, product_price: price, product_quantity: quantity },
                dataType: "json"
            }).done(function (result) {
                console.log(result);
            })


        })
    })
}






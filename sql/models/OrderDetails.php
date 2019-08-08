<?php


class OrderDetails
{
    private $id;
    private $quantityOrdered;
    private $priceEach;
    private $totalPrice;
    private $orderId;
    private $productId;




    public function __construct($quantity_ordered, $price_each, $order_id, $product_id)
    {
        $this->quantity_ordered = $quantity_ordered;
        $this->priceEach = $price_each;
        $this->totalPrice = $quantity_ordered * $price_each;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of quantityOrdered
     */ 
    public function getQuantityOrdered()
    {
        return $this->quantityOrdered;
    }

    /**
     * Set the value of quantityOrdered
     *
     * @return  self
     */ 
    public function setQuantityOrdered($quantityOrdered)
    {
        $this->quantityOrdered = $quantityOrdered;

        return $this;
    }

    /**
     * Get the value of priceEach
     */ 
    public function getPriceEach()
    {
        return $this->priceEach;
    }

    /**
     * Set the value of priceEach
     *
     * @return  self
     */ 
    public function setPriceEach($priceEach)
    {
        $this->priceEach = $priceEach;

        return $this;
    }

    /**
     * Get the value of totalPrice
     */ 
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set the value of totalPrice
     *
     * @return  self
     */ 
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get the value of orderId
     */ 
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set the value of orderId
     *
     * @return  self
     */ 
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get the value of productId
     */ 
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @return  self
     */ 
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }


    // insertion dans la base de données

    public function save()
    {
        $cnx = new Connexion();


        // méthode d'insertion dans la base de données
        $cnx->querySQL("INSERT INTO order_detail (quantity_ordered, price_each, total_price, order_id, product_id) VALUES (?,?,?,?,?)", [
            $this->quantityOrdered,
            $this->priceEach,
            $this->totalPrice,
            $this->orderId,
            $this->productId
        ]);
    }



    public function getOrderDetailsByOrder($id)
    {
        $cnx = new Connexion();
        $result = $cnx->getMany(
            "SELECT * FROM order_details WHERE order_id = ?",
            get_class($this),
            [$id]
        );
        return $result;
    }


 }

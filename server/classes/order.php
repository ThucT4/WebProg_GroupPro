<?php
class Order
{
    public $id;
    public $customerID;
    public $customerName;
    public $productName;
    public $img;
    public $productID;
    public $date;
    public $from;
    public $to;
    public $productList;

    public function __construct($id, $customerID, $customerName, $productName, $img, $productID, $date, $from, $to)
    {
        $product1 = new Product("SB3589", "../public/img/product1.png", "Fashion, modern and trending with real iron materials", "Knife", "2500$", "1", "In stock");
        $product2 = new Product("UI359", "../public/img/product2.webp", "Bluetooth headphone with famous branch - experience music, watch movies all day", "Headphone", "200$", "1", "In stock");
        $this->id  = $id;
        $this->customerID = $customerID;
        $this->customerName = $customerName;
        $this->productName  = $productName;
        $this->img = $img;
        $this->productID = $productID;
        $this->date = $date;
        $this->from = $from;
        $this->to = $to;
        $this->productList = array($product1, $product2);
    }
}

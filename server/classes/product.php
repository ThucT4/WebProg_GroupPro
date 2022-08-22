<?php
class Product
{
    public $productID;
    public $img;
    public $productDes;
    public $category;
    public $unitPrice;
    public $amount;
    public $status;

    public function __construct($productID, $img, $productDes, $category, $unitPrice, $amount, $status)
    {
        $this->productID  = $productID;
        $this->img  = $img;
        $this->productDes = $productDes;
        $this->category  = $category;
        $this->unitPrice = $unitPrice;
        $this->amount = $amount;
        $this->status = $status;
    }
}
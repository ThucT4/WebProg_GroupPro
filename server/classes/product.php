<?php
class Product
{
    public $productID;
    public $vendorID;
    public $productName;
    public $img;
    public $productDes;
    public $category;
    public $unitPrice;
    public $amount;
    public $status;

    public function __construct($vendorID, $productName, $img, $productDes, $category, $unitPrice, $amount, $status)
    {
        $productList = readFromLocalFile('product.txt');
        $this->vendorID = $vendorID;
        $this->productID  = sizeof($productList) + 1;
        $this->productName = $productName;
        $this->img  = $img;
        $this->productDes = $productDes;
        $this->category  = $category;
        $this->unitPrice = $unitPrice;
        $this->amount = $amount;
        $this->status = $status;
    }
}

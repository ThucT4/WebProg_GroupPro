<?php require_once('../server/readFromFile.php') ?>
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
    public $status;

    public function __construct($customerID, $customerName, $img, $productID, $date, $from, $to, $productList, $status)
    {
        //automatic increment ID objects
        $orderList = readFromFile("order.txt");
        $this->id  = sizeof($orderList) + 1;
        //assign the value 
        $this->customerID = $customerID;
        $this->customerName = $customerName;
        $this->img = $img;
        $this->productID = $productID;
        $this->date = $date;
        $this->from = $from;
        $this->to = $to;
        $this->productList = $productList;
        $this->status = $status;
    }
}

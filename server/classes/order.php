
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '../server/readFromFile.php');
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

    public function __construct($customerID, $customerName, $img, $productID, $date, $from, $to, $productList)
    {
        //automatic increment ID objects
        $orderList = readFromLocalFile("order.txt");
        $this->id  = sizeof($orderList) + 1;
        //assign the value 
        $this->customerID = $customerID;
        $this->customerName = $customerName;
        $this->img = $img;
        $this->productID = $productID;
        $this->date = $date;
        //from = distribution hub
        $this->from = $from;
        //to = customer address
        $this->to = $to;
        $this->productList = $productList;
        $this->status = "active";
    }
}

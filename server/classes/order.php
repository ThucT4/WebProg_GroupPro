
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '../server/readFromFile.php');
class Order
{
    public $id;
    public $customerName;
    public $firstimg;
    public $date;
    public $from;
    public $to;
    public $productList;
    public $distributionHub;
    public $status;

    public function __construct($customerName, $firstimg, $date, $from, $to, $productList, $distributionHub)
    {
        //automatic increment ID objects
        $orderList = readFromLocalFile("order.txt");
        $this->id  = sizeof($orderList) + 1;
        //assign the value 
        $this->customerName = $customerName;
        $this->firstimg = $firstimg;
        //auto generate current date
        $this->date = $date;
        //from = distribution hub
        $this->from = $from;
        //to = customer address
        $this->to = $to;
        $this->productList = $productList;
        $this->distributionHub = $distributionHub;
        $this->status = "active";
    }
}

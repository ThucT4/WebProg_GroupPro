
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '../server/readFromFile.php');
class Order
{
    public $id;
    public $customerName;
    public $img;
    public $productID;
    public $date;
    public $from;
    public $to;
    public $productList;
    public $distrubutionHub;
    public $status;

    public function __construct($customerName, $img, $productID, $date, $from, $to, $productList, $distrubutionHub)
    {
        //automatic increment ID objects
        $orderList = readFromLocalFile("order.txt");
        $this->id  = sizeof($orderList) + 1;
        //assign the value 
        $this->customerName = $customerName;
        $this->img = $img;
        $this->productID = $productID;
        //auto generate current date
        $this->date = $date;
        //from = distribution hub
        $this->from = $from;
        //to = customer address
        $this->to = $to;
        $this->productList = $productList;
        $distrubutionHub->distrubutionHub = $distrubutionHub;
        $this->status = "active";
    }
}

<?php require_once('./readFromFile.php') ?>
<?php require_once('./writeToFile.php') ?>
<?php
echo $_POST['changeOrderStatus'];
echo "<br><br>";
print_r($_POST);
if (isset($_POST['changeOrderStatus'])) {
    $object = $_POST['changeOrderStatus'];
    $orderList = readFromFile("order.txt");
    foreach ($orderList as $orderItem) {
        if ($orderItem->id == $object) {
            $orderItem->status = "Delivered";
            break;
        }
        changeConfirmStatus($orderList);
    }
}
?>
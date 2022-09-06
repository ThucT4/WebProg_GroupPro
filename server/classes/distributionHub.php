<?php
class DistributionHub
{
    public $name;
    public $address;

    public function __construct($name, $address)
    {
        $this->name  = $name;
        $this->address = $address;
    }
}
?>
<?php
class Account
{
    public $username;
    public $password;
    public $type;
    public $avt;
    public $address;
    public $bussName;
    public $bussAddress;
    public $hub;

    public function __construct($username, $password, $avt, $type, $address, $bussName, $bussAddress, $hub)
    {
        $this->username  = $username;
        $this->password = $password;
        $this->avt = $avt;
        $this->type = $type;
        $this->address  = $address;
        $this->bussName = $bussName;
        $this->bussAddress = $bussAddress;
        $this->hub = $hub;
    }
}
?>
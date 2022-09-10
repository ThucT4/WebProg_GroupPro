<?php
session_start();
loadPage();

function loadPage()
{
    //Header
    require_once("../../../src/components/header/header.php");

    //Main
    require_once("../../../src/components/privacyPage/privacyPage.html");

    //Footer
    //require_once("../../../src/components/footer/footer.html");
}

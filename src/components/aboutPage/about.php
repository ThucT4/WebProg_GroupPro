<?php

loadPage();

    function loadPage() {
        //Header
        require_once("../../../src/components/header/header.html");

        //Main
        require_once("../../../src/components/aboutPage/about.html");

        //Footer
        //require_once("../../../src/components/footer/footer.html");
    }
?>
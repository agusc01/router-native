<?php
    require_once 'helpers/get.php';

    echo "GET. Nitsuga<hr>";
    include_once 'pages/nitsuga/views/components/navbar.php';
    echo "Hi ".  GET::stringParameter('name','there') ." ! Nitsuga";
?>

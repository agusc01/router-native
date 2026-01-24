<?php include_once 'pages/nitsuga/views/components/head.php'; ?>
<!-- More links or scripts -->
</head>
<body>
<?php
    require_once 'helpers/get.php';

    echo "GET. Nitsuga<hr>";
    include_once 'pages/nitsuga/views/components/navbar.php';
    echo "Hi ".  GET::stringParameter('name','there') ." ! Nitsuga";
?>
</body>
</html>
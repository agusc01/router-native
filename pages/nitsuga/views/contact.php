<?php
    require_once 'helpers/url.php';
    // README: if without Script , you have to put BEFORE the HTML
    // URL::redirectTo('cupoftea');
?>
<?php include_once 'pages/nitsuga/views/components/head.php'; ?>
<!-- More links or scripts -->
</head>
<body>
<?php

    echo "Contact. Nitsuga<hr>";
    include_once 'pages/nitsuga/views/components/navbar.php';

    // README: if with Script , you have to put AFTER the HTML
    URL::redirectToScript('cupoftea');
?>
</body>
</html>
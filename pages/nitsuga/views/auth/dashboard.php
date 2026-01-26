<?php include_once 'pages/nitsuga/views/components/head.php'; ?>
<!-- More links or scripts -->
</head>
<body>
    <?php
        echo "Dashboard [You're an Admin]. Nitsuga <hr>";
    ?>
    <div>
        <button onclick="window.location.href='/<?= MAIN_FOLDER ?>/home';">home</button>
        <button onclick="window.location.href='/<?= MAIN_FOLDER ?>/logout';">logout</button>
    </div>
</body>
</html>
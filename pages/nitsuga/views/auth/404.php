<?php include_once 'pages/nitsuga/views/components/head.php'; ?>
<!-- More links or scripts -->
</head>
<body>
    <?php echo "Page Not Found (Admin). Nitsuga<hr>";?>
    <button onclick="window.location.href='/<?= MAIN_FOLDER ?>/home';">home (root)</button>
    <button onclick="window.location.href='/<?= MAIN_FOLDER ?>/auth';">home (admin)</button>
</body>
</html>
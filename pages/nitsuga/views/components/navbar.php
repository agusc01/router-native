<?php require_once 'config/_index.php'; ?>
<?php require_once 'pages/nitsuga/guards.php'; ?>
<ul>
    <li><a href="/<?= MAIN_FOLDER ?>/home">Home</a></li>
    <li>Generate <a href="/<?= MAIN_FOLDER ?>/captcha">captcha</a></li>
    <li>Send <a href="/<?= MAIN_FOLDER ?>/email">email</a></li>
    <li>Use <a href="/<?= MAIN_FOLDER ?>/database">database</a>. Note: if you want to download in excel <a href="/<?= MAIN_FOLDER ?>/database-excel" target="_blank" >click here</a> or if you want to download in PDF <a href="/<?= MAIN_FOLDER ?>/database-pdf" target="_blank" >click here</a></li>
    <li>Handle <a href="/<?= MAIN_FOLDER ?>/grettings?name=John Doe">GET</a>. Note: See the params</li>
    <li>Have fun with <a href="/<?= MAIN_FOLDER ?>/forms">forms</a></li>
    <li>Routes with title <a href="/<?= MAIN_FOLDER ?>/title">see</a> [Dynamics]</li>
    <li>Look <a href="/<?= MAIN_FOLDER ?>/contact">redirection</a>. Note: It can do it wiht PHP and JS</li>
    <?php $url404 = "strange_url-".uniqid();?>
    <li><a href="/<?= MAIN_FOLDER ?>/<?= $url404;?>">Page not found</a>. Note: Watch the url [<?= $url404;?>]</li>
    <?php if(NitsugaGuard::isLogged('home',false)):?>
        <li>YOU'RE AUTHORIZED <a href="/<?= MAIN_FOLDER ?>/login">see dashboard (indirect)</a></li>
        <li>YOU'RE AUTHORIZED <a href="/<?= MAIN_FOLDER ?>/auth/dashboard">see dashboard (direct)</a></li>
    <?php else:?>
        <li>Login <a href="/<?= MAIN_FOLDER ?>/login">authorized users only</a>. Note: Using Guards with time (SessionController)</li>
    <?php endif;?>
    <li>Guards ! <a href="/<?= MAIN_FOLDER ?>/protected">Private without access</a>. or <a href="/<?= MAIN_FOLDER ?>/protected?pass=go">Private with access</a></li>
    <li>Save a <a href="/<?= MAIN_FOLDER ?>/file">file or more than one</a></li>
</ul>
<hr>
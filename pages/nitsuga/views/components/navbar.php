<?php require_once 'config/_index.php'; ?>
<ul>
    <li><a href="/<?= MAIN_FOLDER ?>/home">Home</a></li>
    <li>Generate <a href="/<?= MAIN_FOLDER ?>/captcha">captcha</a></li>
    <li>Send <a href="/<?= MAIN_FOLDER ?>/email">email</a></li>
    <li>Use <a href="/<?= MAIN_FOLDER ?>/database">database</a></li>
    <li>Handle <a href="/<?= MAIN_FOLDER ?>/grettings?name=John Doe">GET</a>. Note: See the params</li>
    <li>Have fun with <a href="/<?= MAIN_FOLDER ?>/forms">forms</a></li>
    <li>Look <a href="/<?= MAIN_FOLDER ?>/contact">redirection</a>. Note: It can do it wiht PHP and JS</li>
    <?php $url404 = "strange_url-".uniqid();?>
    <li><a href="/<?= MAIN_FOLDER ?>/<?= $url404;?>">Page not found</a>. Note: Watch the url [<?= $url404;?>]</li>
    <li><a href="/<?= MAIN_FOLDER ?>/protected">Private without access</a>. or <a href="/<?= MAIN_FOLDER ?>/protected?pass=go">Private with access</a></li>
</ul>
<hr>
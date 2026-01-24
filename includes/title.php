<?php
    require_once 'config/_index.php';
    require_once 'controllers/website-controller.php';

    $defaultTitle = WebsiteController::current()->nameWebsite ?? '';
    $titleCurrentPage = $defaultTitle . ' | '  . ($route['title'] ??  DEFAULT_TITLE_MSG);
?>
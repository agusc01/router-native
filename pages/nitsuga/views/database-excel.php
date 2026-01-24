<?php
    require_once 'helpers/excel.php';
    require_once 'pages/nitsuga/controllers/colour-controller.php';

    $data = ColourController::getAll();
    Excel::download($data, "custom_name_colours");
?>

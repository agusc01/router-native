<?php
    require_once 'helpers/pdf.php';
    require_once 'pages/nitsuga/controllers/colour-controller.php';

    $data = ColourController::getAll();
    PDF::download($data, "custom_name_colours");
?>

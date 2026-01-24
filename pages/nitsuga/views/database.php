<?php

    include_once 'pages/nitsuga/models/colour-model.php';
    include_once 'pages/nitsuga/controllers/colour-controller.php';

    echo "Database. Nitsuga <hr>";
    include_once 'pages/nitsuga/views/components/navbar.php';

    // $colour = new Colour(['nameColor' => 'new color', 'hexaColor' => '012345']);
    // ColourController::createOne($colour);
    // $colour1 = ColourController::getOneById(7);
    $colours = ColourController::getAll();
    // $colour1->nameColor = 'vert instead green';
    // ColourController::updateOne($colour1);
    // ColourController::deleteOneById(1);
    // $colours_after = ColourController::getAll();
    
    echo "<pre>";
    // var_dump($colour);
    // echo "<hr>";
    // var_dump($colour1);
    // echo "<hr>";
    var_dump($colours);
    // echo "<hr>AFTER<br>";
    // var_dump($colours_after);
    echo "</pre>";
?>

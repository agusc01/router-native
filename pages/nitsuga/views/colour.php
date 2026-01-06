<?php

    require_once 'controllers/_index.php';
    require_once 'models/_index.php';
    include_once 'pages/nitsuga/models/_index.php';
    include_once 'pages/nitsuga/controllers/_index.php';

    echo "Colours. Nitsuga <hr>";

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

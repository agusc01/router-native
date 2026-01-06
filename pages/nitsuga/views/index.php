<?php

    echo "Home. Nitsuga<br>";
    
    require_once 'helpers/get.php';
    require_once 'helpers/post.php';

    // var_dump(GET::stringParameter("hola"));
    // echo "<br>";

    // $_POST["lolo"] = "migel";
    // $_POST["lolo"]["tutu"] = "migel";

            // if (!isset($_POST['successMessages']))
            // {
            //     $_POST['successMessages'] = [];
            // }


    // POST::setSuccessMessage("lala","beni");
    // echo "metodo: ";
    // var_dump(POST::getSuccessMessages());
    // echo "<br>";
    // echo "variable: ";
    // var_dump($_POST);


    $validations = [
        'nombreColor' => [ 'validator' => 'Validator::stringCustomLength' ,  'minLength' => 5,  'maxLength' => 20,   'name' => 'nombre' ],
        // 'aliasColor' => [ 'validator' => 'Validator::stringMaxLength' , 'maxLength' => '12'  , 'name' => 'alias' ],
        // 'descriptionColor' => [ 'validator' => 'Validator::stringMinLength' , 'minLength' => '8'  , 'name' => 'alias' ],
        // 'hexaColor' => [ 'validator' => null ],
        // 'ordenColor' => [ 'validator' => 'Validator::positiveNumber' , 'name' => 'orden' ],
        // 'ordenColor' => [ 'validator' => 'Validator::numberMin' , 'min' => 12 , 'name' => 'orden' ],
        // 'ordenColor' => [ 'validator' => 'Validator::numberMax' , 'max' => 20 , 'name' => 'orden' ],
        'ordenColor' => [ 'validator' => 'Validator::numberBetween' , 'min' => 12, 'max' => 20 , 'name' => 'orden' ],
    ];

    POST::validation($validations);
    echo "<pre>";
    var_dump(POST::getErrorMessages());
    echo "</pre>";
?>



<form action="" method="POST">
    <input type="text" name="nombreColor" id="nombreColor" value="">
    <!-- <input type="text" name="aliasColor" id="aliasColor" value="" placeholder="alias"> -->
    <!-- <input type="text" name="descriptionColor" id="descriptionColor" value="" placeholder="description"> -->
    <!-- <input type="color" name="hexaColor" id="hexaColor" value=""> -->
    <input type="number" name="ordenColor" id="ordenColor" value="">
    <button>sent</button>
</form>

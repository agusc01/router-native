<?php

    require_once 'helpers/post.php';

    echo "Forms. Nitsuga<hr>";
    include_once 'pages/nitsuga/views/components/navbar.php';


    $validations = [
        'nameColour' => [ 'validator' => 'Validator::stringCustomLength' ,  'minLength' => 5,  'maxLength' => 20,   'name' => 'name of colour' ],
        'aliasColour' => [ 'validator' => 'Validator::stringMaxLength' , 'maxLength' => '12'  , 'name' => 'alias' ],
        'descriptionColour' => [ 'validator' => 'Validator::stringMinLength' , 'minLength' => '8'  , 'name' => 'description' ],
        'hexaColour' => [ 'validator' => null ],
        'ordenColour' => [ 'validator' => 'Validator::positiveNumber' , 'name' => 'orden' ],
        'weightColour' => [ 'validator' => 'Validator::numberMin' , 'min' => 12 , 'name' => 'orden' ],
        'numberColour' => [ 'validator' => 'Validator::numberMax' , 'max' => 20 , 'name' => 'orden' ],
        'sizeColour' => [ 'validator' => 'Validator::numberBetween' , 'min' => 12, 'max' => 20 , 'name' => 'orden' ],
    ];

    $inputs = POST::validation($validations);
    echo "<pre>";
    var_dump(POST::getErrorMessages());
    echo "<hr>";
    var_dump($inputs);
    echo "</pre>";
?>


<form action="" method="POST">
    <input type="text" name="nameColour" id="nameColour" value="" placeholder="nameColour">
    <input type="text" name="aliasColour" id="aliasColour" value="" placeholder="alias">
    <input type="text" name="descriptionColour" id="descriptionColour" value="" placeholder="description">
    <input type="color" name="hexaColour" id="hexaColour" value="<?=  $inputs['hexaColour'] ?? ''; ?>">
    <input type="number" name="ordenColour" id="ordenColour" value="" placeholder="ordenColour">
    <input type="number" name="weightColour" id="weightColour" value="" placeholder="weightColour">
    <input type="number" name="numberColour" id="numberColour" value="" placeholder="numberColour">
    <input type="number" name="sizeColour" id="sizeColour" value="" placeholder="sizeColour">
    <button>sent</button>
</form>

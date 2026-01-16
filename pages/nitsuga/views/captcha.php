<?php

    // Randomly choose a number of images between 2 and 9
    $imageCount = rand(2, 9); 

    // Initialize an array for the random numbers
    $randomNumbers = [];

    // Generate random numbers and store them in the array
    for ($i = 0; $i < $imageCount; $i++)
    {
        $randomNumbers[] = rand(0, 9);
    }

    // Create the list of images using the generated random numbers
    $imagePaths = [];
    for ($i = 0; $i < $imageCount; $i++)
    {
        $imagePaths[] = 'assets/captcha/' . $randomNumbers[$i] . '.jpg'; // Construct image paths
    }

    // Get the dimensions of each image and calculate the total width
    $totalWidth = 0; // Total width
    $maxHeight = 0; // Maximum height
    $imageResources = []; // Array for image resources

    foreach ($imagePaths as $imagePath)
    {
        $info = getimagesize($imagePath); // Get image dimensions
        $totalWidth += $info[0]; // Accumulate total width
        $maxHeight = max($maxHeight, $info[1]); // Get maximum height
        $imageResources[] = imagecreatefromjpeg($imagePath); // Create image resource
    }

    // Create a new image with the calculated dimensions
    $backgroundImage = imagecreatetruecolor($totalWidth, $maxHeight);

    // Copy each image into the background image
    $xOffset = 0;
    foreach ($imageResources as $resource)
    {
        imagecopy($backgroundImage, $resource, $xOffset, 0, 0, 0, imagesx($resource), imagesy($resource)); // Copy image to background
        $xOffset += imagesx($resource);
    }

    // Save the resulting image
    imagejpeg($backgroundImage, 'assets/captcha/randoms/'.time().'_'.uniqid().'.jpg');

    imagedestroy($backgroundImage); // Free the background image resource
    // Free resources
    foreach ($imageResources as $resource)
    {
        imagedestroy($resource); // Free each image resource
    }



    //     ,`isCheckedCaptcha` BOOLEAN NOT NULL

    // CREATE TABLE IF NOT EXISTS `captcha` (
    //     `idCaptcha` INT UNSIGNED NOT NULL AUTO_INCREMENT
    //     ,`urlImagenCaptcha` VARCHAR(80) NOT NULL
    //     ,`valueCaptcha` VARCHAR(10) NOT NULL
    //     ,`createAtCatpcha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP

    //     ,CONSTRAINT `pk_colores` PRIMARY KEY (`idCaptcha`)
    // ) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;


    // real-time: I create it
    // async-await: I verify and delete it (with the  urlImagenCaptcha delete the file and then I make a DELETE WHERE) ...
    // ... I delete every catpcha's that have more than 10 minutes

?>
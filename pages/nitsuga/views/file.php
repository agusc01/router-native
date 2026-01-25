<?php include_once 'config/_index.php'; ?>
<?php include_once 'helpers/post.php'; ?>
<?php include_once 'controllers/file-controller.php'; ?>
<?php include_once 'pages/nitsuga/views/components/head.php'; ?>
<!-- More links or scripts -->
</head>
<body>
<?php
    echo "File. Nitsuga<hr>";
    include_once 'pages/nitsuga/views/components/navbar.php';
    if(POST::isPost())
    {
        // README: --------------- IMAGES -------------------
        [$isSaved, $uploadedFiles] = FileController::saveAllImages('inputImages', 'assets/uploads/');

        if ($isSaved) 
        {
            foreach ($uploadedFiles as [$pathImage, $imageName]) 
            {
                echo "path: $pathImage<hr>";
                $file = new File([
                    'nameFile' => $imageName,
                    'urlFile' => $pathImage
                ]);
                FileController::createOne($file);
            }
        }

        // README: --------------- PDF -------------------
        [$isSaved, $pathPDF, $PDFName] = FileController::savePDF('inputPDF', 'assets/uploads/');
        if($isSaved)
        {
            echo "path $pathPDF<hr>";
            $file = new File([
                'nameFile' => $PDFName,
                'urlFile' => $pathPDF
            ]);
            FileController::createOne($file);
        }      

        echo "<pre>"; 
        var_dump ($_FILES);
        echo "</pre>";
    }
?>
<form action="" method="POST" enctype="multipart/form-data">
    <label>
        Images
        <input type="file" name="inputImages[]" id="inputImages[]" multiple accept="<?= '.' . implode(', .', ALLOWED_IMAGE_EXTENSIONS); ?>">
    </label>
    <label>
        PDF
        <input type="file" name="inputPDF" id="inputPDF" accept="<?= '.' . implode(', .', ALLOWED_PDF_EXTENSIONS); ?>">
    </label>
    <button>sent</button>
</form>
</body>
</html>
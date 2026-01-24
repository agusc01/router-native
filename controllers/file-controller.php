<?php
    require_once 'config/_index.php';
    require_once 'helpers/post.php';
    require_once 'controllers/base-controller.php';
    require_once 'controllers/query-controller.php';
    
    class FileController extends BaseController
	{
        // CREATE TABLE files (
        //     idFile INT AUTO_INCREMENT PRIMARY KEY,
        //     nameFile VARCHAR(200) NOT NULL,
        //     urlFile VARCHAR(250) NOT NULL
        // );

		public static $model = 'File';
		public static $table = 'files';
        
        private static function save($inputFileName, $uploadDirectory, $allowedExtensions)
        {
            if (POST::isPost()) 
            {
                if (isset($_FILES[$inputFileName]) && $_FILES[$inputFileName]['error'] == UPLOAD_ERR_OK) 
                {
                    $temporaryPath = $_FILES[$inputFileName]['tmp_name'];
                    $fileName = $_FILES[$inputFileName]['name'];
                    $componentsName = explode(".", $fileName);
                    $fileExtension = strtolower(end($componentsName));
                    $nameWithoutExtension = strtolower(reset($componentsName));

                    if (in_array($fileExtension, $allowedExtensions)) 
                    {
                        $currentDate = date('Y-m-d_H-i-s');
                        $uploadedImageUrl = $currentDate . '_' . uniqid() . '_' . $nameWithoutExtension . '.' . $fileExtension;
                        $destinationPath = $uploadDirectory . $uploadedImageUrl;

                        if (move_uploaded_file($temporaryPath, $destinationPath)) 
                        {
                            return [true, $destinationPath, $uploadedImageUrl]; // Return the path of the uploaded file
                        }
                    }
                }
            }
            return [false, '', '']; // Invalid request method or other error
        }

        private static function saveAll($inputFileName, $uploadDirectory, $allowedExtensions)
        {
            $uploadedFiles = [];
            
            if (POST::isPost()) 
            {
                if (isset($_FILES[$inputFileName]) && $_FILES[$inputFileName]['error'][0] == UPLOAD_ERR_OK) 
                {
                    $totalFiles = count($_FILES[$inputFileName]['name']);
                    
                    for ($i = 0; $i < $totalFiles; $i++) 
                    {
                        if ($_FILES[$inputFileName]['error'][$i] == UPLOAD_ERR_OK) 
                        {
                            $temporaryPath = $_FILES[$inputFileName]['tmp_name'][$i];
                            $fileName = $_FILES[$inputFileName]['name'][$i];
                            $componentsName = explode(".", $fileName);
                            $fileExtension = strtolower(end($componentsName));
                            $nameWithoutExtension = strtolower(reset($componentsName));

                            if (in_array($fileExtension, $allowedExtensions)) 
                            {
                                $currentDate = date('Y-m-d_H-i-s');
                                $uploadedImageUrl = $currentDate . '_' . uniqid() . '_' . $nameWithoutExtension . '.' . $fileExtension;
                                $destinationPath = $uploadDirectory . $uploadedImageUrl;

                                if (move_uploaded_file($temporaryPath, $destinationPath)) 
                                {
                                    $uploadedFiles[] = [$destinationPath, $uploadedImageUrl]; 
                                }
                            }
                        }
                    }
                }
            }

            return (count($uploadedFiles) > 0) ? [true, $uploadedFiles] : [false, '', '']; 
        }

        // *************************************** ONE ****************************************

        public static function savePDF($inputFileName, $uploadDirectory, $allowedExtensions = ALLOWED_PDF_EXTENSIONS)
        {
            return self::save($inputFileName, $uploadDirectory, $allowedExtensions);
        }

        public static function saveWord($inputFileName, $uploadDirectory, $allowedExtensions = ALLOWED_WORD_EXTENSIONS)
        {
            return self::save($inputFileName, $uploadDirectory, $allowedExtensions);
        }

        public static function saveExcel($inputFileName, $uploadDirectory, $allowedExtensions = ALLOWED_EXCEL_EXTENSIONS)
        {
            return self::save($inputFileName, $uploadDirectory, $allowedExtensions);
        }

        public static function saveImage($inputFileName, $uploadDirectory, $allowedExtensions = ALLOWED_IMAGE_EXTENSIONS)
        {
            return self::save($inputFileName, $uploadDirectory, $allowedExtensions);
        }

        // *************************************** MULTIPLE ****************************************
        
        public static function saveAllPDFs($inputFileName, $uploadDirectory, $allowedExtensions = ALLOWED_PDF_EXTENSIONS)
        {
            return self::saveAll($inputFileName, $uploadDirectory, $allowedExtensions);
        }

        public static function saveAllWords($inputFileName, $uploadDirectory, $allowedExtensions = ALLOWED_WORD_EXTENSIONS)
        {
            return self::saveAll($inputFileName, $uploadDirectory, $allowedExtensions);
        }

        public static function saveAllExcels($inputFileName, $uploadDirectory, $allowedExtensions = ALLOWED_EXCEL_EXTENSIONS)
        {
            return self::saveAll($inputFileName, $uploadDirectory, $allowedExtensions);
        }

        public static function saveAllImages($inputFileName, $uploadDirectory, $allowedExtensions = ALLOWED_IMAGE_EXTENSIONS)
        {
            return self::saveAll($inputFileName, $uploadDirectory, $allowedExtensions);
        }

        // *************************************** ******** ****************************************
	}


?>
<?php
    require_once 'controllers/website-controller.php';

    class Excel
    {
        public static function download($data, $fileName = 'excel', $headerColor = '#000', $headerBackground= '#cfcfcf') 
        {
            $website = WebsiteController::current();
            $date = date('Y-m-d_H-i-s');
            $nameWebsite = str_replace(' ','_',$website->nameWebsite);
            $nameWebsite = strtolower($nameWebsite);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
            header('Pragma: no-cache');
            header('Expires: 0');
            header('Content-Disposition: attachment; filename="'.$nameWebsite.'_'.$fileName.'_'.$date.'.xls"');
            header('Content-Type: application/ms-excel; charset=utf-8');

            $content = '<table>';
            
            if (!empty($data))
            {
                $firstClient = get_object_vars($data[0]);

                // Create header row
                $content .= "<tr>";
                foreach ($firstClient as $key => $value)
                {
                    $content .= "<th style='color:$headerColor; background-color:$headerBackground'>$key</th>";
                }
                $content .= "</tr>";

                // Populate the table with client data
                foreach ($data as $client)
                {
                    $content .= "<tr>";
                    
                    // Get the object properties
                    foreach (get_object_vars($client) as $value) {
                        $content .= "<td>$value</td>";
                    }

                    $content .= "</tr>";
                }
            }
            
            $content .= '</table>';
                
            echo iconv('utf-8', 'cp1251//TRANSLIT', "$content");
        }
 
    }
?>

<?php

    require_once 'controllers/website-controller.php';
    require_once 'assets/dompdf-3.0.1/autoload.inc.php';

    use Dompdf\Dompdf;
    use Dompdf\Options;

    class PDF
    {
        public static function download($data, $fileName = 'documento', $headerColor = '#000', $headerBackground = '#cfcfcf')
        {
            $website = WebsiteController::current();
            $date = date('Y-m-d_H-i-s');
            $nameWebsite = str_replace(' ', '_', $website->nameWebsite);
            $nameWebsite = strtolower($nameWebsite);

            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($options);
            ob_start();
            
            ?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?= htmlspecialchars($nameWebsite) ?> - <?= htmlspecialchars($fileName) ?></title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th {
                        color: <?= htmlspecialchars($headerColor) ?>;
                        background-color: <?= htmlspecialchars($headerBackground) ?>;
                        padding: 10px;
                    }
                    td {
                        padding: 10px;
                        border: 1px solid #ddd;
                    }
                    .no-data {
                        text-align: center;
                        padding: 20px;
                        font-size: 18px;
                    }
                </style>
            </head>
            <body>
            <h1><?= htmlspecialchars($website->nameWebsite) ?></h1>
            <table>
                <?php
                    if (!empty($data) && is_array($data))
                    {
                        echo "<tr>";
                        foreach (get_object_vars($data[0]) as $key => $value)
                        {
                            echo "<th>" . htmlspecialchars($key) . "</th>";
                        }
                        echo "</tr>";

                        foreach ($data as $client)
                        {
                            echo "<tr>";
                            foreach (get_object_vars($client) as $value)
                            {
                                echo "<td>" . htmlspecialchars($value) . "</td>";
                            }
                            echo "</tr>";
                        }
                    } 
                    else 
                    {
                        echo "<tr><td colspan='100%' class='no-data'>There is not data to show.</td></tr>";
                    }
                ?>
            </table>
            </body>
            </html>
            <?php
            $html = ob_get_clean();

            // Load the HTML at Dompdf
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            // Download the PDF
            $dompdf->stream($nameWebsite."_".$fileName."_".$date.".pdf", ["Attachment" => true]);
        }
    }
?>

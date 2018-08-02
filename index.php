<?php
include "includes.php";


$dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

?>

<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="/js/main.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="/js/lightbox.js"></script>
        <link href="/css/lightbox.css" rel="stylesheet">
        <title><?= "Bilder | " . TITLE ?></title>
    </head>
    <body class="container">
        <h1 class="display-1 m-4">Bilder (assets/examples/italy)</h1>
        <table id="content" class="bg-light">
        <?php
        foreach ($dbh->query('SELECT id FROM assets WHERE path LIKE "/examples/italy/"') as $row) {
            $json = file_get_contents("http://".PIMCORE_HOST."/webservice/rest/asset/id/".$row["id"]."?apikey=".API_KEY);
            $obj = json_decode($json, true)["data"];

            $metaDaten = "";
            $title = "";
            $desc = "";
            foreach ($obj["metadata"] as $i ) {
                $metaDaten .= "<li>".$i["name"]." = ".$i["data"]."</li>";
                if (strtolower($i["name"]) == "title") {
                    $title = htmlspecialchars($i["data"]);
                }
                if (strtolower($i["name"]) == "description") {
                    $desc = htmlspecialchars($i["data"]);
                }
            }

            echo "<tr class=''><td class='w-50'><a href='data:" . $obj["mimetype"] . ";base64, " . $obj["data"] . "' data-alt='Hier sollte ein Bild erscheinen... :(' data-lightbox='".$obj["path"]."' data-title='".$title."<br><small>$desc</small>'><img class='pb-4 rounded w-75' src='data:" . $obj["mimetype"] . ";base64, " . $obj["data"] . "'></a></td><td class='w-25'><pre><h2 onclick='titleOnClick(this)'>$title</h2><b>Dateiname:</b> ".$obj["filename"]."<br><br><b>Erstellungsdatum:</b> ".date("d.m.Y, H:i:s", strtotime($obj["creationDate"]))."<br><b>Zuletzt geändert:</b> ".date("d.m.Y, H:i:s", strtotime($obj["modificationDate"]))."<br><br><b>Metadaten:</b><br><ul>".$metaDaten."</ul></pre><br><br><a href='edit.php?id=".$row["id"]."' class='btn btn-secondary'>Metadaten bearbeiten</a></td></tr>";
        }
        ?>
        </table>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </body>
</html>
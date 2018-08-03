<?php
include "includes.php";

$json = file_get_contents("http://".PIMCORE_HOST."/webservice/rest/user?apikey=".API_KEY);
$obj = json_decode($json, true)["data"];
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
        <link href="/css/main.css" rel="stylesheet">
        <title><?= "Bilder | " . TITLE ?></title>
    </head>
    <body class="container">
        <?php include "navbar.php" ?>
        <h1 class="display-1 m-4">Benutzer <small>(<?= $obj["name"] ?>)</small></h1>
        <ul class="list-group bg-light">
            <?php
            $toShow = array(
                "firstname",
                "lastname",
                "roles"
            );
            foreach ($toShow as $ts) {
                $string = "";
                if(is_array($obj[$ts])) {
                    foreach ($obj[$ts] as $s) {
                        $string .= "$s<br>";
                    }
                } else {
                    $string = $obj[$ts];
                }
                if ($string == "") $string = "=== Kein Wert gesetzt ===";
                echo "<li class='list-group-item'><h2>$ts</h2>$string</li>";
            }
            ?>
        </ul>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </body>
</html>
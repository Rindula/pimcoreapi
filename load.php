<?php
include "includes.php";
$dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

foreach ($dbh->query('SELECT id FROM assets WHERE path LIKE "/examples/italy/"') as $row) {
    $json = file_get_contents("http://".PIMCORE_HOST."/webservice/rest/asset/id/".$row["id"]."?apikey=".API_KEY);
    $obj = json_decode($json, true)["data"];

    $metaDaten = "";
    $title = "";
    $desc = "";
    foreach ($obj["metadata"] as $i) {
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

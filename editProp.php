<?php
include "includes.php";

$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $key = $_POST["key"];
    $value = $_POST["value"];
    $meta = array();
    for ($i=0; $i < count($key); $i++) { 
        if (empty($key[$i])) continue;
        $meta[] = array("name" => $key[$i], "data" => $value[$i], "type" => "input", "language" => "");
    }
    $json = file_get_contents("http://".PIMCORE_HOST."/webservice/rest/asset/id/$id?apikey=".API_KEY);
    $obj = json_decode($json, true);
    $obj["data"]["properties"] = $meta;

    unset($obj["success"]);

    $url = "http://".PIMCORE_HOST."/webservice/rest/asset?apikey=".API_KEY;

    $options = array(
        'http' => array(
            'header'  => array("Content-type: application/json"),
            'method'  => 'POST',
            'content' => json_encode($obj["data"])
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    header("Location: ./editProp.php?id=".$id);
    die($result);
};


$json = file_get_contents("http://".PIMCORE_HOST."/webservice/rest/asset/id/$id?apikey=".API_KEY);
$obj = json_decode($json, true)["data"];

?>

<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>
        $(document).ready(function(){
            $.ajax({
                url: "http://<?= PIMCORE_HOST ?>/webservice/rest/asset/id/<?=$id?>?apikey=<?=API_KEY?>", 
                crossDomain: true,
                dataType:"jsonp",
                success: function(result){
                    $.each(result, function(i, field){
                        console.log(field);
                        
                        $("#form").append(field + " ");
                    });
                }
            });

        });

        </script>
        <title><?= "Bild editieren | " . TITLE ?></title>
    </head>
    <body class="container">
        <?php include "navbar.php" ?>
        <form action="" method="post" id="form">
        <p>Leer lassen zum löschen</p>
        <?php
        foreach ($obj["properties"] as $row) {
            
        ?>
        <div class="input-group mt-4 def">
            <input autocomplete="off" placeholder="Name" class="form-control" type="text" name="key[]" value="<?= $row["name"] ?>"> <input autocomplete="off" placeholder="Wert" class="form-control" type="text" name="value[]" value="<?= $row["data"] ?>">
        </div>
        <?php
        }
        ?>

        <div class="input-group mt-4">
            <input autocomplete="off" placeholder="Name" class="form-control" type="text" name="key[]" value=""> <input autocomplete="off" placeholder="Wert" class="form-control" type="text" name="value[]" value="">
        </div>
        <br>
        <button name="submit" class="btn btn-success" type="submit">Speichern</button>
        <a class="btn btn-outline-danger" href="/">Zurück</a>
        </form>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </body>
</html>
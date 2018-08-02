<?php
include "../includes.php";


if(isset($_FILES['image']))
{
    $errors=array();
    $allowed_ext= array('jpg','jpeg','png','gif');
    $file_name =$_FILES['image']['name'];
    $file_ext = strtolower( end(explode('.',$file_name)));


    $file_size=$_FILES['image']['size'];
    $file_tmp= $_FILES['image']['tmp_name'];

    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
    $data = file_get_contents($file_tmp);
    $base64 = base64_encode($data);



    if(in_array($file_ext,$allowed_ext) === false)
    {
        $errors[]='Extension not allowed';
    }

    if($file_size > 2097152)
    {
        $errors[]= 'File size must be under 2mb';

    }
    if(empty($errors))
    {
        $arr = array("data" => array(
                "data" => utf8_encode($base64),
                "parentId" => 37,
                "type" => "image",
                "filename" => utf8_encode($file_name),
                "path" => "/examples/italy/",
                "mimetype" => utf8_encode($type),
                "creationDate" => time(),
                "modificationDate" => time(),
                "userOwner" => null,
                "userModification" => null,
                "properties" => null,
                "customSettings" => array(
                    "imageWidth" => 2000,
                    "imageHeight" => 1500,
                    "imageDimensionsCalculated" => true
                ),
                "metadata" => array(),
                "notes" => array(),
                "checksum" => array(
                    "algo" => "sha1",
                    "value" => utf8_encode(sha1($base64))
                )
            )
        );
        
        $url = "http://".PIMCORE_HOST."/webservice/rest/asset?apikey=".API_KEY;
        
        $options = array(
            'http' => array(
                'header'  => array("Content-type: application/json"),
                'method'  => 'POST',
                'content' => json_encode($arr["data"])
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        header("Location: /");
        die($result);

    }
    else
    {
        $errMsg = "";
        foreach($errors as $error)
        {
            $errMsg .= $error . '<br/>'; 
        }
    }
   //  print_r($errors);

}
?>
<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="/js/main.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <link href="/css/main.css" rel="stylesheet">
        <title><?= "Bilder | " . TITLE ?></title>
    </head>
    <body class="container">
        <?php include "../navbar.html" ?>
        <?= (!empty($errors)) ? '<div class="alert alert-danger" role="alert">'.$errMsg.'</div>' : "" ?>
        <h1 class="display-1 m-4">Hochladen</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <p>
            <label class="file-upload btn btn-primary"><span class="file-upload-text">
                            Bild auswählen
                        </span><input name="image" type="file"></label><br>
                <input class="btn btn-outline-success" type="submit" value="Hochladen">

            </p>
        </form>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </body>
</html>
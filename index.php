<?php
include "includes.php";
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
        <script>
            var xhr = new XMLHttpRequest();
		  	xhr.onreadystatechange = function() {
			    if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        document.getElementById("content").innerHTML = xhr.responseText;
                    } else {
                        document.getElementById("content").innerHTML = "<tr><td><a class='btn btn-warning btn-block' href='javascript:location.reload()'><span class='text-danger'>Fehler beim laden! (Errorcode "+xhr.status+")</span> Neu laden</a></td></tr>";
                    }
			        
			    }
			}
			xhr.open('GET', 'load.php', true);
			xhr.send(null);
        </script>
    </head>
    <body class="container">
        <h1 class="display-1 m-4">Bilder (assets/examples/italy)</h1>
        <table id="content" class="table bg-light">
            <tr><td><img class="img-thumbnail d-block mx-auto" src="/images/loading.gif" /></td></tr>
        </table>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </body>
</html>
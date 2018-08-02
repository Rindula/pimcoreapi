<?php

include "includes.php";

$id = $_POST["id"];

$json = file_get_contents("http://".PIMCORE_HOST."/webservice/rest/asset/id/$id?apikey=".API_KEY);
$obj = json_decode($json, true);
$meta = $obj["data"]["metadata"];

$titPos = -1;
$cnt = 0;
foreach ($meta as $m) {
    if (strtolower($m["name"]) == "title") {
        $titPos = $cnt;
    }
    $cnt++;
}

$meta[($titPos >= 0) ? $titPos : count($meta)] = array("name" => "title", "language" => "", "type" => "input", "data" => $_POST["title"]);


$obj["data"]["metadata"] = $meta;

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

header("Location: /");
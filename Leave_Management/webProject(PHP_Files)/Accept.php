<?php

include_once('db.php');

$postdata = file_get_contents("php://input");
$req = json_decode($postdata);

// Extract, validate and sanitize the id.
$id = ($_GET['id'] !== null && (int)$_GET['id'] > 0)? mysqli_real_escape_string($mysqli, (int)$_GET['id']) : false;

if(!$id)
{
  return http_response_code(400);
}

$sql = "UPDATE `leave` SET `request`='accepted' WHERE `id` = '{$id}'";
$sql2 = "UPDATE `leave` SET `request`='accepted' WHERE `id` = '{$id}'";

mysqli_query($mysqli, $sql);

$mysqli->close();
?>
<?php

include_once('db.php');

$postdata = file_get_contents("php://input");
$req = json_decode($postdata);

// Extract, validate and sanitize the id.
$id = ($_GET['id'] !== null && (int)$_GET['id'] > 0)? mysqli_real_escape_string($mysqli, (int)$_GET['id']) : false;
$reason = ($_GET['reason'] !== null && trim($_GET['reason']) > 0)? mysqli_real_escape_string($mysqli, trim($_GET['reason'])) : false;

if(!$id && !$reason)
{
  return http_response_code(400);
}

$sql = "UPDATE `leave` SET `request`='declined',`reason`= '$reason' WHERE `id` = '{$id}'";
mysqli_query($mysqli, $sql);

$mysqli->close();
?>
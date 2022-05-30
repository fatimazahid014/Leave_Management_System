<?php

include_once('db.php');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

// Extract, validate and sanitize the id.
$id = ($_GET['id'] !== null && (int)$_GET['id'] > 0)? mysqli_real_escape_string($mysqli, (int)$_GET['id']) : false;

if(!$id)
{
  return http_response_code(400);
}
  $sql = "SELECT *  FROM `admin` WHERE `id` = {$id} LIMIT 1";
  
  if ($result = mysqli_query($mysqli, $sql)) {
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    echo json_encode($rows);
  } else {
    http_response_code(404);
  }
$mysqli->close();
?>
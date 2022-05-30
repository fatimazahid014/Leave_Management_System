<?php
include_once('db.php');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$sql = "SELECT *  FROM admin WHERE status <> 'Admin'
  Order By id ASC" ;

if ($result = mysqli_query($mysqli, $sql)) {
  $users = array();
  while ($row = mysqli_fetch_assoc($result)) {
      $users[] = $row;
  }
  echo json_encode($users);
} else {
  http_response_code(404);
}

$mysqli->close();
?>
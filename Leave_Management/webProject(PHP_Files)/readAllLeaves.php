<?php
include_once('db.php');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$sql = "SELECT * FROM `leave`";

if ($result = mysqli_query($mysqli, $sql)) {
    $leaves = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $leaves[] = $row;
    }
    echo json_encode($leaves);
} else {
  http_response_code(404);
}

$mysqli->close();
?>
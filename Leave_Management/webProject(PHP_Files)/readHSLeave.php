
<?php
include_once('db.php');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$sql = "SELECT * FROM `leave` WHERE `status` = 'student' AND `request`='accepted' OR (`request` = '' AND `days` > 10)
  Order By `id` ASC" ;

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
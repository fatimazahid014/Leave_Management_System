<?php


include_once("db.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if (isset($postdata) && !empty($postdata)) {

    $password = mysqli_real_escape_string($mysqli, trim($request->password));
    $email = mysqli_real_escape_string($mysqli, trim($request->email));

    $sql = "SELECT * FROM admin where email='$email' and password='$password'";
    if ($result = mysqli_query($mysqli, $sql)) {
        $rows = array();
        
        // output data of each row and store in $rows array
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        http_response_code(404);
    }
}
?>

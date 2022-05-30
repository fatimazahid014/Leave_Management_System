<?php 

    include_once("db.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

if (isset($postdata) && !empty($postdata)) {

    $firstname = mysqli_real_escape_string($mysqli, trim($request->firstname));
    $lastname = mysqli_real_escape_string($mysqli, trim($request->lastname));
    $dept = mysqli_real_escape_string($mysqli, trim($request->dept));
    $days = mysqli_real_escape_string($mysqli, (int)$request->days);
    $status =  mysqli_real_escape_string($mysqli, trim($request->status));
    $SQuota = mysqli_real_escape_string($mysqli, (int)$request->SQuota));

    $sql = "INSERT INTO `leave`(`firstname`, `lastname`, `dept`, `status`, `days`,`quota`) VALUES ('$firstname','$lastname','$dept','$status',$days , '$SQuota')";
    
    if($result = $mysqli->query($sql))
    {
        http_response_code(201);
        $leaves = [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'dept' => $dept,
        'status' => $status,
        'days' => $days,
        ];
        echo json_encode($leaves);
    }
    else
    {
        http_response_code(422);
    }
}  
$mysqli->close();

?>
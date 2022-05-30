<?php

include_once('db.php');

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  $id = mysqli_real_escape_string($mysqli, (int)$request->id);
  $firstname = mysqli_real_escape_string($mysqli, trim($request->firstname));
  $lastname= mysqli_real_escape_string($mysqli, trim($request->lastname));
  $email = mysqli_real_escape_string($mysqli, trim($request->email));
  $status = mysqli_real_escape_string($mysqli, trim($request->status));
 
  // Update.
  $sql = "UPDATE `admin` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`status`='$status' WHERE `id` = '{$id}'";

  if($result = $mysqli->query($sql))
  {
    http_response_code(201);
    $user = [
      'firstname' => $firstname,
      'lastname' => $lastname,
      'email'    => $email,
      'password' => $password,
      'status'    => $status,
    ];
    echo json_encode($user);
  }
    else
    {
      return http_response_code(422);
    }  
  
}
$mysqli->close();
?>
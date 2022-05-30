<?php
include_once('db.php');


// Get the posted data.
$postdata = file_get_contents("php://input");

//echo $postdata;
if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  $firstname = mysqli_real_escape_string($mysqli, trim($request->firstname));
  $lastname= mysqli_real_escape_string($mysqli, trim($request->lastname));
  $email = mysqli_real_escape_string($mysqli, trim($request->email));
  $password= mysqli_real_escape_string($mysqli, trim($request->password));
  $status = mysqli_real_escape_string($mysqli, trim($request->status));

  // Create.
  $sql = "INSERT INTO admin (firstname,lastname,email,password,status) VALUES ('{$firstname}','{$lastname}','{$email}','{$password}','{$status}')";

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
    http_response_code(422);
  }
}
$mysqli->close();
?>
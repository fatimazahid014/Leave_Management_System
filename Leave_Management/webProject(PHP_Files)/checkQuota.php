
<?php 

include_once("db.php");

    
    $sql = "SELECT *  FROM quota WHERE status='student'";
    $sql2 = "SELECT *  FROM quota WHERE status='faculty'";

    $res = $mysqli->query($sql2);

    if($result =  $mysqli->query($sql))
    {   
        $quota = array();
        $row1 = mysqli_fetch_assoc($result);
        $row2 = mysqli_fetch_assoc($res);

        $quota[] = $row1['quota'];
        $quota[] = $row2['quota'];
       
        echo json_encode($quota);
    }
    else
    {
        http_response_code(422);
    }

$mysqli->close();

?>
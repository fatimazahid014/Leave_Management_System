
<?php 

    include_once("db.php");


    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

if (isset($postdata) && !empty($postdata)) {

    $sq = mysqli_real_escape_string($mysqli, trim($request->sq));
    $fq = mysqli_real_escape_string($mysqli, trim($request->fq));


    $sql =  "UPDATE `quota` SET `quota`='{$sq}' WHERE `status` = 'student'";
    $sql2 =  "UPDATE `quota` SET `quota`='{$fq}' WHERE `status` = 'faculty'";

    //$mysqli->query($sql);
    $mysqli->query($sql2);

    if($result =  $mysqli->query($sql))
    {
        http_response_code(201);
        $quota = [
        'sq' => $sq,
        'fq' => $fq,
        ];
        echo json_encode($quota);
    }
    else
    {
        http_response_code(422);
    }
}
    
$mysqli->close();

?>
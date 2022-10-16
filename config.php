<?php
    $con = mysqli_connect("localhost", "root", "", "Disease");
    mysqli_query($con,'SET NAMES utf8');

    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    
    $statement = mysqli_prepare($con, "SELECT symptom, treatment FROM skinDisease WHERE name = ?");
    mysqli_stmt_bind_param($statement, "s", $name);
    mysqli_stmt_execute($statement);


    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $symptom, $treatment);

    $response = array();
    $response["success"] = false;
 
    while(mysqli_stmt_fetch($statement)) {
        $response["success"] = true;
        $response["symptom"] = $symptom;
        $response["treatment"] = $treatment;   
    }

    echo json_encode($response);

?>
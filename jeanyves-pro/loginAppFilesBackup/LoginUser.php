<?php
    require("db_config.php");

    $con = mysqli_connect($host, $username, $password, $database);

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    //Some dummy data
    $fname = "First Name";
    $lname = "Last Name";
    $age = "99";
    $phone = "021xxxxxx";
    $email = "anemail@testing.com";
    $user = "username";
    $pass = "password";


    $statement = mysqli_prepare($con, "SELECT * FROM Users WHERE USERNAME = ? AND PASSWORD = ?");
    mysqli_stmt_bind_param($statement, "ss", $username, $password);
    mysqli_stmt_execute($statement);

    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID, $fname, $lname, $age, $phone, $email, $user, $pA);

    $response = array();
    $response["success"] = false;

    while(mysqli_stmt_fetch($statement)){
        $response["success"] = true;
        $response["firstName"] = $fname;
        $response["lastName"] = $lname;
        $response["age"] = $age;
        $response["phone"] = $phone;
        $response["email"] = $email;
        $response["user"] = $user;
        $response["pass"] = $pass;
    }

    echo json_encode($response);
?>
<?php
    

    $fName = $_POST["firstName"];
    $lName = $_POST["lastName"];
    $age = $_POST["age"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $user = $_POST["username"];
    $pass = $_POST["password"]; 
    
    //TESTING DUMMY DATA
    /*$fName = "Timmy";
    $lName = "Birdy";
    $age = "26";
    $phone = "0218955";
    $email = "emails@killingus.com";
    $user = "timmyturner";
    $pass = "testing124";*/
        
    
    require("db_config.php");

    $con=mysqli_connect($host, $username, $password, $database);
    // Check connection
    if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

    $statement = mysqli_prepare($con,"INSERT INTO Users (FIRSTNAME, LASTNAME, AGE, PHONE, EMAIL, USERNAME, PASSWORD) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Perform a query, check for error
    if (!$statement){
      echo("Error description: " . mysqli_error($con));
      }
    if (!mysqli_stmt_bind_param($statement,"sssssss", $fName, $lName, $age, $phone, $email, $user, $pass)){
      echo("Error description: " . mysqli_error($con));
      }
    if (!mysqli_stmt_execute($statement)){
      echo("Error description: " . mysqli_error($con));
      }

    mysqli_close($con);

    $response = array();
    $response["success"] = true;
    echo json_encode($response);
    
?>
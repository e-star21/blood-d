<?php
$name = $_POST['t1'];
$gender = $_POST['r1'];
$age = $_POST['t2'];
$mobile = $_POST['t3'];
$b_id =$_POST['t4'];
$email = $_POST['t5'];
$pwd = $_POST['t6'];
if (!empty($name) || !empty($pwd) || !empty($gender) || !empty($email) || !empty($age) || !empty($phone) || !empty($b_id)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "bloodbank";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From donorregistration Where email = ? Limit 1";
     $INSERT = "INSERT Into donorregistration (name, gender, age,mobile,b_id,email.,pwd) values(?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssii", $name, $gender,$age,$mobile,$b_id, $email, $pwd);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
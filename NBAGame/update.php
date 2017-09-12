<?php
session_start();
include "dbh.php";
$username = $_POST['username'];
$email = $_POST['email'];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];
$location = $_POST["location"];

//query old username, email and password
$id = $_SESSION['id'];
$sql1 = "SELECT * FROM user WHERE id = '$id'";
$result = mysqli_query($conn,$sql1);
$row=mysqli_fetch_assoc($result);
$password_old = $row["pwd"];
$email_old = $row["email"];
$username_old = $row["username"];
$location_old = $row["Location"];
mysqli_free_result($result);

//check whether whether user has changed username/email/password or not
if($username == $username_old){
	$output_message .= "You did not change your username!"."///";
}
else{
	$sql2 = "UPDATE user SET username = '$username'
WHERE id = '$id'";
	$result = mysqli_query($conn,$sql2);
	mysqli_free_result($result);
	$output_message .= "You have changed your username to ".$username."///";
}

if($email == $email_old){
	$output_message .="You did not change your email!"."///";
}
else{
	$sql3 = "UPDATE user SET email = '$email'
WHERE id = '$id'";
	$result = mysqli_query($conn,$sql3);
	mysqli_free_result($result);
	$output_message .= "You have changed your username to ".$email."///";
}

if($password1 == $password_old or $password1 != $password2 or $password1 == ""){
	$output_message .= "You did not change your password!/ You did not enter the same password for confirmation!"."///";
}
else{
	$sql4 = "UPDATE user SET pwd = '$password1'
WHERE id = '$id'";
	$result = mysqli_query($conn,$sql4);
	mysqli_free_result($result);
	$output_message .= "You have changed your username to "."$password1"."///";
}

if($location != "NONONO" and $location != $location_old){
    $sql5 = "UPDATE user SET Location = '$location'
    WHERE id = '$id'";
    $result = mysqli_query($conn,$sql5);
    mysqli_free_result($result);
    $output_message .= "You have changed your State to "."$location"."";
}
else{
    $output_message .= "You did not change your State!"."";
}
    
    echo "<script type='text/javascript'>alert('$output_message');</script>";
    echo "<script>window.location = 'update_page.php';</script>";
    
mysqli_close($conn);


?>

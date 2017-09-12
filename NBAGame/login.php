<?php
session_start();
include 'dbh.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE username = '$username' AND pwd = '$password'";
$result = $conn->query($sql);

if (!$row = $result->fetch_assoc()){
    echo "Your username or password is incorrect!";
}
else {
	$_SESSION['id'] = $row['id'];
}

header("Location: index.php");
?>

<?php
session_start();
include 'dbh.php';

$team1 = $_POST['preteam'];
$id = $_SESSION['id'];





$sql_team = "INSERT INTO Favorite_team (Teams_Name, Users_ID) 
VALUES
('$team1', '$id');";
mysqli_query($conn,$sql_team);

header("Location: index.php");

?>

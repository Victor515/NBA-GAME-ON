<?php
session_start();
include 'dbh.php';


$player1 = $_POST['preplayer'];
$id = $_SESSION['id'];


$sql_player = "INSERT INTO Favorite_player (Players_Name, Users_ID) 
VALUES
('$player1', '$id');";
mysqli_query($conn, $sql_player);


echo "<script>window.location = 'index.php';</script>";
?>

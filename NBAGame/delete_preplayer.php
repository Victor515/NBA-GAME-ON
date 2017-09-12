<?php
session_start();
include 'dbh.php';


$player1 = $_POST['preplayer'];
$id = $_SESSION['id'];


$sql_player = "DELETE FROM Favorite_player WHERE Players_Name = '$player1' ";

mysqli_query($conn, $sql_player);


header("Location: index.php");
?>

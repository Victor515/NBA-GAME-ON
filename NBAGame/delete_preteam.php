<?php
session_start();
include 'dbh.php';


$team1 = $_POST['preteam'];
$id = $_SESSION['id'];


$sql_player = "DELETE FROM Favorite_team WHERE Teams_Name = '$team1' ";

mysqli_query($conn, $sql_player);


header("Location: index.php");
?>

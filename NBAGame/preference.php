<?php
session_start();
include 'dbh.php';

$team1 = $_POST['fteam1'];
$team2 = $_POST['fteam2'];
$team3 = $_POST['fteam3'];
$player1 = $_POST['fplayer1'];
$player2 = $_POST['fplayer2'];
$player3 = $_POST['fplayer3'];
$id = $_SESSION['id'];

    
    if(strlen($player1) > 1)
    {
    $sql_player1 = "INSERT INTO Favorite_player (Players_Name, Users_ID)
    VALUES
    ('$player1', '$id');";
    mysqli_query($conn, $sql_player1);
    }
    
    if(strlen($player2) > 1){
    $sql_player2 = "INSERT INTO Favorite_player (Players_Name, Users_ID)
    VALUES
    ('$player2', '$id');";
    mysqli_query($conn, $sql_player2);
    }
    
    if(strlen($player3) > 1){
    $sql_player3 = "INSERT INTO Favorite_player (Players_Name, Users_ID)
    VALUES
    ('$player3', '$id');";
    mysqli_query($conn, $sql_player3);
    }
   


    
    if(strlen($team1) > 1)
    {
        $sql_team1 = "INSERT INTO Favorite_team (Teams_Name, Users_ID)
        VALUES
        ('$team1', '$id');";
        mysqli_query($conn, $sql_team1);
    }
    
    if(strlen($team2) > 1){
        $sql_team2 = "INSERT INTO Favorite_team (Teams_Name, Users_ID)
        VALUES
        ('$team2', '$id');";
        mysqli_query($conn, $sql_team2);
    }
    
    if(strlen($team3) > 1){
        $sql_team3 = "INSERT INTO Favorite_team (Teams_Name, Users_ID)
        VALUES
        ('$team3', '$id');";
        mysqli_query($conn, $sql_team3);
    }
header("location: index.php");

?>

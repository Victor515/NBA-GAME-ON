<?php
session_start();
include "dbh.php";

//query old fplayer
$id = $_SESSION['id'];
$sql1 = "SELECT Teams_Name FROM Favorite_team WHERE Users_ID = $id";
$result = mysqli_query($conn,$sql1);
$count = 0;
   
while($row=mysqli_fetch_assoc($result))
{
	$count++;
	$fteam_old[$count] = $row["Teams_Name"];
}

mysqli_free_result($result);

//get new players and update
for($i = 1; $i <= $count; $i++){
	$fteam[$i] = $_POST['fteam'.$i];
	$sql = "UPDATE Favorite_team SET Teams_Name = '$fteam[$i]'
	WHERE Users_ID = '$id' AND Teams_Name = '$fteam_old[$i]'";
	$result = mysqli_query($conn,$sql);
	mysqli_free_result($result);
}

// echo messages to the user
$output_message = "You have changed your Favorite_player to:";
for($i = 1; $i <= $count; $i++){
	$output_message .= $fteam[$i]."/";
}
    echo "<script type='text/javascript'>alert('$output_message');</script>";
    echo "<script>window.location = 'update_page.php';</script>";

mysqli_close($conn);


?>

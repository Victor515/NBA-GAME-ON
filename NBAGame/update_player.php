<?php
session_start();
include "dbh.php";

//query old fplayer
$id = $_SESSION['id'];
$sql1 = "SELECT Players_Name FROM Favorite_player WHERE Users_ID = $id";
$result = mysqli_query($conn,$sql1);
$count = 0;
   
while($row=mysqli_fetch_assoc($result))
{
	$count++;
	$fplayer_old[$count] = $row["Players_Name"];
}

mysqli_free_result($result);

//get new players and update
for($i = 1; $i <= $count; $i++){
	$fplayer[$i] = $_POST['fplayer'.$i];
	$sql = "UPDATE Favorite_player SET Players_Name = '$fplayer[$i]'
	WHERE Users_ID = '$id' AND Players_Name = '$fplayer_old[$i]'";
	$result = mysqli_query($conn,$sql);
	mysqli_free_result($result);
}

// echo messages to the user
$output_message = "You have changed your Favorite_player to:";
for($i = 1; $i <= $count; $i++){
	$output_message .= $fplayer[$i]."/";
}
//echo "<script type='text/javascript'>alert('$output_message');</script>";


mysqli_close($conn);
    
    echo "<script type='text/javascript'>alert('$output_message');</script>";
    echo "<script>window.location = 'update_page.php';</script>";

?>

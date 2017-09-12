<?php
    session_start();
    include 'dbh.php';
    $currid = $_SESSION['id'];
    ?>
<!DOCTYPE html>
<html>
<head>
<title>NBA Game On</title>

<link href="form.css" type="text/css" rel="stylesheet">

</head>
<body>

<div class="header">
<div class="container">
<ul class="nav">
<?php
                        if (isset($_SESSION['id'])) {
                        ?>
                    <a href="./index.php"><li>Home</li></a>
                    <a class="afterlogin" href='./logout.php'><li>Log out</li></a>
                    <a href="./signup_page.php"><li>Sign up</li></a>
                    <a class="afterlogin" href='./update_page.php'><li>Profile</li></a>
                    <?php
                        }
                        else {
                    ?>
                    <a href="./index.php"><li>Home</li></a>
                    <a href ="./login_page.php"><li>Log in</li></a>
                    <a href="./signup_page.php"><li>Sign up</li></a>
                    <?php
                        }
                    ?>
</ul>
</div>
</div>


<div class="jumbotron">

    <div class="container">

        <div class="main">


        </div>

    </div>

</div>



<div style="width: 100%; overflow:auto;">

<?php
mysql_connect("localhost","sometimesnaive_dalao1","Dalaodalao1");
mysql_select_db('sometimesnaive_my_DB');


$search = $_POST['TITLE'];
$selectoption = $_POST['rankStandard'];

if($search != ''){
	if ($selectoption == 'player') {
		if (preg_match("/^[a-zA-Z]+/", $search)) {
			$sql = "SELECT * FROM player WHERE name LIKE '%$search%' ";
			$result =  mysql_query($sql) or die(mysql_error());
			if (mysql_num_rows($result)==0) {
				echo "<p>No result is found in $selectoption category, please check your input.</p>";
			}
			echo "<table>";
			$first_row = true;
			while ($row = mysql_fetch_assoc($result)) {
					if ($first_row) {
        				$first_row = false;
                        echo '<thead>';
        				echo '<tr>';
        				foreach($row as $key => $field) {
           					echo '<th>' . htmlspecialchars($key) . '</th>';
        				}
                        if (isset($_SESSION['id'])) {
                        echo '<th>Perference</th>';
                        }
        				echo '</tr>';
                        echo '</thead>';
        			}
                    echo '<tbody>';
        			echo '<tr>';
                    $first_col1 = true;
					foreach ($row as $key => $field) {
                        if($first_col1){
                            $first_col1 = false;
                            $temp1 = htmlentities($field);
                        }
						echo '<td>' . htmlentities($field).'</td>';
					}
                if (isset($_SESSION['id'])) {
                    $duplicate="SELECT DISTINCT Players_Name FROM Favorite_player WHERE Users_ID = $currid";
                    $re=mysqli_query($conn, $duplicate);
                    $judge = 1;
                    while($r=mysqli_fetch_assoc($re))
                    {
                        if($r['Players_Name']==$temp1){
                            $judge=2;
                        }
                    }
                    if($judge==1){
                        echo '<form action="add_preplayer.php" method="post" ><td><input type="hidden" name="preplayer" value="'. "$temp1".'"><input type="submit" value="prefer" class="btn-prefer"></td></form>';
                    }
                    else{
                        echo '<form action="delete_preplayer.php" method="post" ><td><input type="hidden" name="preplayer" value="'. "$temp1".'"><input type="submit" value="delete" class="btn-delete"></td></form>';
                    }
                    
                }
                echo '</tr>';
			}
                echo '</tbody>';
				echo '</table>';
		}
			else{
				echo "<p>Please input English letters!</p>";
			}
	}
	elseif ($selectoption == 'team') {
		if (preg_match("/^[a-zA-Z0-9]+/", $search)) {
			$sql = "SELECT * FROM Teams_Statistics WHERE Team_name LIKE '%$search%' ";
			$result =  mysql_query($sql) or die(mysql_error());
			if (mysql_num_rows($result)==0) {
				echo "<p>No result is found in $selectoption category, please check your input.</p>";
			}
            
			echo '<table>';
			$first_row = true;
			while ($row = mysql_fetch_assoc($result)) {
					if ($first_row) {
        				$first_row = false;
                        echo '<thead>';
        				echo '<tr>';
        				foreach($row as $key => $field) {
           					echo '<th>' . htmlspecialchars($key) . '</th>';
        				}
                        if (isset($_SESSION['id'])) {
                            echo '<th>Score_Leader</th>';
                        }
                        if (isset($_SESSION['id'])) {
                            echo '<th>Perference</th>';
                        }
        				echo '</tr>';
                        echo '</thead>';
        			}
        			echo '<tr>';
                    $first_col2 = true;
					foreach ($row as $key => $field) {
                        if($first_col2){
                            $first_col2 = false;
                            $temp2 = htmlentities($field);
                        }
						echo '<td>' . htmlentities($field).'</td>';
							
					}
					echo "<td><a href='./scorehero.php?team=$row[short_name]'><li>Find the Score Leader</li></a></td>";
                if (isset($_SESSION['id'])) {
                    $duplicate="SELECT DISTINCT Teams_Name FROM Favorite_team WHERE Users_ID = $currid";
                    $re=mysqli_query($conn, $duplicate);
                    $judge = 1;
                    while($r=mysqli_fetch_assoc($re))
                    {
                        if($r['Teams_Name']==$temp2){
                            $judge=2;
                        }
                    }
                    if($judge==1){
                        echo '<form action="add_preteam.php" method="post" ><td><input type="hidden" name="preteam" value="'. "$temp2".'"><input type="submit" value="prefer" class="btn-submit"></td></form>';
                    }
                    else{
                        echo '<form action="delete_preteam.php" method="post" ><td><input type="hidden" name="preteam" value="'. "$temp2".'"><input type="submit" value="delete" class="btn-delete"></td></form>';
                    }
                    
                }
			 	echo '</tr>';
			}
                echo '</tbody>';
                echo '</table>';
            
		}
			else{
				echo "<p>Please input English letters or numbers!</p>";
			}		
	}
}
else{
	echo "<p>Please enter a search query</p>";
}
?>
</div>


</body>
</html>


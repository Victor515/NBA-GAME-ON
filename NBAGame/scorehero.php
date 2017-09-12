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
</div>>


<div class="jumbotron">

<div class="container">

<div class="main">


</div>

</div>

</div>









<?php
mysql_connect("localhost","sometimesnaive_dalao1","Dalaodalao1");
mysql_select_db('sometimesnaive_my_DB');
$team = $_GET['team'];
echo "<h1> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Score Leader</h1>";
$sql = "SELECT * FROM  player WHERE Teamname = '$team' AND Points = (SELECT DISTINCT MAX(Points) FROM player WHERE Teamname = '$team')";
$result =  mysql_query($sql) or die(mysql_error());
echo "<table>";
$first_row = true;
while ($row = mysql_fetch_assoc($result)){
	if ($first_row) {
        	$first_row = false;
        	echo '<tr>';
        	foreach($row as $key => $field) {
           		echo '<th>' . htmlspecialchars($key) . '</th>';
        				}
        
                if (isset($_SESSION['id'])) {
                    echo '<th>Perference</th>';
                }
        
            }
        	echo '</tr>';
    
    
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
            echo '<form action="add_preplayer.php" method="post" ><td><input type="hidden" name="preplayer" value="'. "$temp1".'"><input type="submit" value="prefer" class="btn-submit"></td></form>';
        }
        else{
            echo '<td>Have been Prefered</td>';
        }
    }
    
	echo '</tr>';
	}
	echo '</table>';
 ?>





</body>
</html>

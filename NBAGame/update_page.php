<?php
session_start();
include 'dbh.php';
$currid = $_SESSION['id'];
?>


<!DOCTYPE html>

<html>
    
    <head>
        
        <link href="https://fonts.googleapis.com/css?family=Raleway:400, 600" rel="stylesheet">
            
            <link href="style.css" type="text/css" rel="stylesheet">
                
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


        <div class="jumbotron2">

            <div class="container">

                <div class="main">

                    <h1>Update your Profile</h1>


                </div>

            </div>

        </div>

<br><br>
<br><br>



<div style="width: 100%; overflow:auto;">
<center>
<form action="update.php" method="post" >
<table style="width: 800px;height: 300px; margin-top:4px;margin-left:4px;margin-right:4px;margin-bottom:4px;">
<tr><th style="color: #333333;font-family: Impact, Charcoal, sans-serif;font-size: 50px; text-align: left;">Account Information</th></tr>


<tr><td>
Change username:
<input type="text" name="username"
value="
<?php
    $sql_user= "SELECT username FROM user WHERE id = $currid";
    $result=mysqli_query($conn, $sql_user);
    while($row=mysqli_fetch_assoc($result))
    {
        echo $row["username"];
        
    }
    mysqli_free_result($result);
    ?>

" class="searcherr">
</td></tr>


<tr><td style="text-align:left;">
Change email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
<input type="text" name="email" value ="
<?php
    
    $sql_email= "SELECT email FROM user WHERE id = $currid";
    $result1=mysqli_query($conn, $sql_email);
    while($row=mysqli_fetch_assoc($result1))
    {
        echo $row["email"];
        
    }
    mysqli_free_result($result1);
    ?>

"class="searcherr">
</td></tr>


<tr><td>Change password:
<input type="password" name="password1" class="searcherr" ></td></tr>

<tr><td>
Password confirm:
<input type="password" name="password2" class="searcherr"></td></tr>

<tr><td>
Change your State:
<label>
<select name="location" class="searcherr">
<option value="NONONO">Please select your State</option>
<option value="Alabama">Alabama</option>
<option value="Alaska">Alaska</option>
<option value="Arizona">Arizona</option>
<option value="Arkansas">Arkansas</option>
<option value="California">California</option>
<option value="Colorado">Colorado</option>
<option value="Connecticut">Connecticut</option>
<option value="Delaware">Delaware</option>
<option value="Florida">Florida</option>
<option value="Georgia">Georgia</option>
<option value="Hawaii">Hawaii</option>
<option value="Idaho">Idaho</option>
<option value="Illinois">Illinois</option>
<option value="Indiana">Indiana</option>
<option value="Iowa">Iowa</option>
<option value="Kansas">Kansas</option>
<option value="Kentucky">Kentucky</option>
<option value="Louisiana">Louisiana</option>
<option value="Maine">Maine</option>
<option value="Maryland">Maryland</option>
<option value="Massachusetts">Massachusetts</option>
<option value="Michigan">Michigan</option>
<option value="Minnesota">Minnesota</option>
<option value="Mississippi">Mississippi</option>
<option value="Missouri">Missouri</option>
<option value="Montana">Montana</option>
<option value="Nebraska">Nebraska</option>
<option value="Nevada">Nevada</option>
<option value="New Hampshire">New Hampshire</option>
<option value="New Jersey">New Jersey</option>
<option value="New Mexico">New Mexico</option>
<option value="New York">New York</option>
<option value="North Carolina">North Carolina</option>
<option value="North Dakota">North Dakota</option>
<option value="Ohio">Ohio</option>
<option value="Oklahoma">Oklahoma</option>
<option value="Oregon">Oregon</option>
<option value="Pennsylvania">Pennsylvania</option>
<option value="Rhode Island">Rhode Island</option>
<option value="South Carolina">South Carolina</option>
<option value="South Dakota">South Dakota</option>
<option value="Tennessee">Tennessee</option>
<option value="Texas">Texas</option>
<option value="Utah">Utah</option>
<option value="Vermont">Vermont</option>
<option value="Virginia">Virginia</option>
<option value="Washington">Washington</option>
<option value="West Virginia">West Virginia</option>
<option value="Wisconsin">Wisconsin</option>
<option value="Wyoming">Wyoming</option>
<option value="Washington DC*">Washington DC*</option>
</select>
</label>

</table>
<button type="submit" class = "btn-submit">update</button>
</form>
</center>
<br><br><br><br><br>

<center>
<form action="update_player.php" method="post">

<table style="width: 800px;height: 300px;margin-top:4px;margin-left:4px;margin-right:4px;margin-bottom:4px;">
<tr><th style="color: #333333;font-family: Impact, Charcoal, sans-serif;font-size: 50px; text-align: left;">Favorite Players</th></tr>
<?php
    include 'is_in_pot.php';
    
    $q= "SELECT Players_Name FROM Favorite_player WHERE Users_ID = $currid";
    $result=mysqli_query($conn,$q);
    $count = 0;
   
    while($row=mysqli_fetch_assoc($result))
    {
        $count++;
        if($row){
            if(is_in_pot($row["Players_Name"])){
               $playoff = "Playoffs!&nbsp";
               }
               else
               $playoff = "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
            
        echo"<tr><td>".$playoff."<input type='text' name='fplayer" .$count. "' value ='" . $row["Players_Name"]. " ' class='searcherr'></td></tr>";
        }
        
        
    }
    
    ?>

</table>
<button type="submit" class = "btn-submit">update</button>
</form>
</center>
<br><br><br><br><br>

<center>
<form action="update_team.php" method="post">

<table style="width: 800px;height: 300px;margin-top:4px;margin-left:4px;margin-right:4px;margin-bottom:4px;">
<tr><th style="color: #333333;font-family: Impact, Charcoal, sans-serif;font-size: 50px; text-align: left;">Favorite Teams</th></tr>
<?php
    
    $q= "SELECT Teams_Name FROM Favorite_team WHERE Users_ID = $currid";
    $result=mysqli_query($conn,$q);
    $count = 0;
    
    while($row=mysqli_fetch_assoc($result))
    {
        $count++;
        if($row){
            echo"<tr><td><input type='text' name='fteam" .$count. "' value = ' " . $row["Teams_Name"]. " ' class='searcherr'>"."</td></tr>";
            
        }
    }
    ?>
</table>
<button type="submit" class = "btn-submit">update</button>
</form>
</center>


        <br><br><br><br><br>
        
        
        <div class="footer">
            
            <div class="container">
                
                <p>&copy; NBA Game On 2017</p>
                
            </div>
            
        </div>
        


    </body>

</html>





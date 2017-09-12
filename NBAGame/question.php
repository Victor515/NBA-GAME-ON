<?php
    session_start();
    include 'dbh.php';
?>

<!DOCTYPE html>

<html>

    <head>

        <link href="https://fonts.googleapis.com/css?family=Raleway:400, 600" rel="stylesheet">

            <link href="form.css" type="text/css" rel="stylesheet">
                </head>
                <link href="style.css" type="text/css" rel="stylesheet">

    <body>
        <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
        <script src="main.js"></script>

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



                   
                    <center><h1 style=" width:1200px; height:150px;text-align: center; margin-top:50px;line-height: 150px;border-radius:50px;
                    font-size:300%; font-weight: 700;font-family: 'Raleway', sans-serif;background:url(http://www.asalesguy.com/wp-content/uploads/2016/09/Question-marks-1.jpg); color:white;">
                        Some questions help us to recommand better!</h1></center>
                    
                    <form action="game.php" method="post">
                    <div style="float: left; width:580px; height:350px; margin-left:50px; margin-right:auto;
                    color:#333333;font-family: 'Raleway', sans-serif; font-size: 16px;line-height: 40px;">
                        <br>
                    <!-- <a><?php echo $_SESSION['FT']; ?></a> -->
                    <a><li style="font-size: 18px;font-weight: 900;">You have chosen some favorite teams and how important you think about that for a game recommandation</li></a>
	                <input type="radio" name="FT" value="4"<?php echo ($_SESSION['FT'] =="4")?"checked":'' ?>>Very Important
	                <input type="radio" name="FT" value="3"<?php echo ($_SESSION['FT'] =="3")?"checked":'' ?>>Important
	                <input type="radio" name="FT" value="2"<?php echo ($_SESSION['FT'] =="2")?"checked":'' ?>>So So
	                <input type="radio" name="FT" value="1"<?php echo ($_SESSION['FT'] =="1")?"checked":'' ?>>Less Important
	                <input type="radio" name="FT" value="0"<?php echo ($_SESSION['FT'] =="0")?"checked":'' ?>>I don't care
	                <a><li style="font-size: 18px;font-weight: 900;">How much you like to see a steal in a game</li></a>
	                <input type="radio" name="ST" value="4"<?php echo ($_SESSION['ST'] =="4")?"checked":'' ?>>Crazy about
	                <input type="radio" name="ST" value="3"<?php echo ($_SESSION['ST'] =="3")?"checked":'' ?>>Very much
	                <input type="radio" name="ST" value="2"<?php echo ($_SESSION['ST'] =="2")?"checked":'' ?>>So So
	                <input type="radio" name="ST" value="1"<?php echo ($_SESSION['ST'] =="1")?"checked":'' ?>>Boring
	                <input type="radio" name="ST" value="0"<?php echo ($_SESSION['ST'] =="0")?"checked":'' ?>>I don't care
	                <a><li style="font-size: 18px;font-weight: 900;">How much you love your hometown team</li></a>
	                <input type="radio" name="LO" value="4"<?php echo ($_SESSION['LO'] =="4")?"checked":'' ?>>Crazy about
	                <input type="radio" name="LO" value="3"<?php echo ($_SESSION['LO'] =="3")?"checked":'' ?>>Very much
	                <input type="radio" name="LO" value="2"<?php echo ($_SESSION['LO'] =="2")?"checked":'' ?>>So So
	                <input type="radio" name="LO" value="1"<?php echo ($_SESSION['LO'] =="1")?"checked":'' ?>>Boring
	                <input type="radio" name="LO" value="0"<?php echo ($_SESSION['LO'] =="0")?"checked":'' ?>>I don't care

	                </div>
	                <div style="float: right; width:580px; height:350px; margin-left:auto; margin-right:30px;
                    color:#333333;font-family: 'Raleway', sans-serif; font-size: 16px;line-height: 40px;">
	                    <br>
	                <a><li style="font-size: 18px;font-weight: 900;">You have chosen some favorite players and how important you think about that for a game recommandation</li></a>
	                <input type="radio" name="FP" value="4"<?php echo ($_SESSION['FP'] =="4")?"checked":'' ?>>Very Important
	                <input type="radio" name="FP" value="3"<?php echo ($_SESSION['FP'] =="3")?"checked":'' ?>>Important
	                <input type="radio" name="FP" value="2"<?php echo ($_SESSION['FP'] =="2")?"checked":'' ?>>So So
	                <input type="radio" name="FP" value="1"<?php echo ($_SESSION['FP'] =="1")?"checked":'' ?>>Less Important
	                <input type="radio" name="FP" value="0"<?php echo ($_SESSION['FP'] =="0")?"checked":'' ?>>I don't care
	                <a><li style="font-size: 18px;font-weight: 900;">How much you like to see a block in a game</li></a>
	                <input type="radio" name="BL" value="4"<?php echo ($_SESSION['BL'] =="4")?"checked":'' ?>>Crazy about
	                <input type="radio" name="BL" value="3"<?php echo ($_SESSION['BL'] =="3")?"checked":'' ?>>Very much
	                <input type="radio" name="BL" value="2"<?php echo ($_SESSION['BL'] =="2")?"checked":'' ?>>So So
	                <input type="radio" name="BL" value="1"<?php echo ($_SESSION['BL'] =="1")?"checked":'' ?>>Boring
	                <input type="radio" name="BL" value="0"<?php echo ($_SESSION['BL'] =="0")?"checked":'' ?>>I don't care
	                <a><li style="font-size: 18px;font-weight: 900;">How long time you can wait for the game</li></a>
	                <input type="radio" name="LG" value="4"<?php echo ($_SESSION['LG'] =="4")?"checked":'' ?>>Can't wait
	                <input type="radio" name="LG" value="3"<?php echo ($_SESSION['LG'] =="3")?"checked":'' ?>>ASAP
	                <input type="radio" name="LG" value="2"<?php echo ($_SESSION['LG'] =="2")?"checked":'' ?>>So So
	                <input type="radio" name="LG" value="1"<?php echo ($_SESSION['LG'] =="1")?"checked":'' ?>>Less cared
	                <input type="radio" name="LG" value="0"<?php echo ($_SESSION['LG'] =="0")?"checked":'' ?>>I don't care
	                </div>
	                <br><br><br>
	                <center><input style="height: 25px;text-align: center; line-height: 5px;border-radius:30px;
                    font-size:100%; font-weight: 700;font-family: 'Raleway', sans-serif;background:url(http://www.asalesguy.com/wp-content/uploads/2016/09/Question-marks-1.jpg);
                    color:white;" type="submit" class = "btn-submit" value="submit"></center>
	                
                    </form>

        

    </body>

</html>


<?php
    session_start();
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

        

        <div class="jumbotron3">

            <div class="container">

                <div class="main">

                    <h1>Where amazing happens</h1>

                    <!--<a class="btn-main" href="#">Get started</a>-->

                    <div class = "search">

                        <form action="searchTitle.php" method="post" target="_self">

                            

                            <!--<h3> Title:</h3>-->

                            <input type="text" name="TITLE" placeholder="Enter your favorite player or team" class="searcher">

                                <select name="rankStandard" class="selector" placeholder = "- -">

                                    <option value="player">Search Player</option>

                                    <option value="team">Search Team</option>

                                </select>

                                <br>

                                <!--<h3>Search by user:</h3>

                                <input name="searchUser" type="radio" value="true" checked="checked" />Yes

                                <input name="searchUser" type="radio" value="false" checked="checked"/>No<br>

                                

                                

                                <h3>Search by genre:</h3>

                                <input name="useGenre" type="radio" value="true"/>Yes

                                <input name="useGenre" type="radio" value="false" checked="checked" />No<br>-->

                                

                                <br><br>

                                <input type="submit" value="SEARCH" class="btn-submit">

                                    

                                    

                                    

                                    <!--    <input name="InFavorites" type="radio" value="1" />Search Favorited Video<br>-->

                                    <br>

                                    </form>



                    </div>

                </div>

            </div>

        </div>

    

        

        

        

        

        <div class="supporting">

            <div class="container">

                

                <div class="col">

                    <img src="https://img.clipartfest.com/fe6512cbe424f39449e93e935992ddb9_basketball-black-and-white-basketball-black-and-white-clipart_843-688.jpeg">

                        <h2>Find Your Game</h2>

                        <p>Find the game that suits you best!<br>Individually!</p>

                        <a class="btn-default" href="./question.php" target = "_blank">Learn more</a>

                        </div>

                

                <div class="col">

                    <img src="https://image.freepik.com/free-icon/quarter-pie-piece-in-circular-graph_318-28979.jpg">

                        <h2>See Players</h2>

                        <p>Use the visualization form to read the information about the players</p>

                        <a class="btn-default" href="./data_visualization_player.php" target = "_blank">Learn more</a>

                        </div>

                

                <div class="col">

                    <img src="http://downloadicons.net/sites/default/files/histogram-statistics-icon-63292.png" >

                        <h2>See Teams</h2>

                        <p>Use the visualization form to read the information about the teams</p>

                        <a class="btn-default" href="./data_visualization.php" target = "_blank">Learn more</a>

                        </div>

                

            </div>

            <div class="clearfix"></div>

        </div>

        

        <div class="footer">

            <div class="container">

                <p>&copy; NBA Game On 2017</p>

            </div>

        </div>

        

    </body>

</html>


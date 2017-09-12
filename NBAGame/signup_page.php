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

        <div class="jumbotron">
            <div class="container">
                <div class="main">
                    <h1>Game On!</h1>
                    <!--<a class="btn-main" href="#">Get started</a>-->
                    <div class = "search">
                        <form action="signup.php" method="post">
                            
                            <!--<h3> Title:</h3>-->
                            <input type="text" name="username" placeholder="Enter your user name:" class="searcher"> <br><br><br>
                            <input type="password" name="password" placeholder="Enter your password:" class="searcher"> <br><br><br>
                            <input type="text" name="email" placeholder="Enter your Emali:" class="searcher">
                                <br><br><br>
                                <!--<h3>Search by user:</h3>
                                 <input name="searchUser" type="radio" value="true" checked="checked" />Yes
                                 <input name="searchUser" type="radio" value="false" checked="checked"/>No<br>
                                 
                                 
                                 <h3>Search by genre:</h3>
                                 <input name="useGenre" type="radio" value="true"/>Yes
                                 <input name="useGenre" type="radio" value="false" checked="checked" />No<br>-->


                                    <label>
                                    <select name="location" class="searcher">
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

                                <br><br>
                                <input type="submit" value="Sign Up" class="btn-submit">
                                    
                                    
                                    
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

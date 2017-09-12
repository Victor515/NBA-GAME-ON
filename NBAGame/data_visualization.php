

<?php
	ob_start();
	session_start();
	//$temp = $_SESSION['POST'];
	//unset($_SESSION['POST']);
    
    
	$servername = "localhost";
	$username = "staysimple_dalao1";
	$server_password = "Dalaodalao1";
	$dbname = "staysimple_sometimesnaive_my_DB";

	$con = mysqli_connect($servername, $username, $server_password,$dbname);
	if (mysqli_connect_errno()) {
		die("Could not connect: " . mysqli_connect_error());
	}
    
    $currid = $_SESSION['id'];
    

	$teamnames = array();
	$win = array();
	$lose = array();
    $conference = array();
    $score = array();
	$index = 0;
    
	$query = "SELECT * FROM Teams_Statistics";
	$result = mysqli_query($con, $query);
	if (!$result) {
     		die('Could not select data: ' . mysqli_error($con));
  	}
  	
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
            $teamnames[$index] = $row["Team_name"];
            $win[$index] = $row["W"];
			$lose[$index] = $row["L"];
            $conference[$index] = $row["Conference"];
            $score[$index] = $row["PTS"];
			$index += 1;
		}
	}
    else {
		echo "No Users Found";
	}

?>






<!DOCTYPE html>
<meta charset="utf-8">

<head>
<title>NBA Game On</title>

<link href="form.css" type="text/css" rel="stylesheet">
<link href="gridline.css" type="text/css" rel="stylesheet">


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


<style>
.d3-tip {
    background-color: hsla(0, 0%, 100%, 0.8);
    /* background-color: hsla(234, 50%, 80%, 0.8); */
color: hsla(0, 0%, 0%, 0.8);
border: solid 1px hsla(0, 0%, 0%, 0.8);
    border-radius: 20px;
    text-align: center;
    min-width: 250px;
    max-width: 250px;
}


.line {
fill: none;
stroke: steelblue;
    stroke-width: 2px;
}

.grid{
stroke: lightgrey;
    stroke-opacity: 0.2;
    shape-rendering: crispEdges;
}

.grid path {
    stroke-width: 0;
}

</style>


<div style = "background-image:url('http://posterizes.com/wp-content/uploads/ChampionsSource24Posterizes2880x18002.jpg');background-size: cover; height: 450px; background-repeat:no-repeat center center">
</div>




<div class="gened_selection">
<br>

<h2 style="padding-left:24px;">Visualization: Team Performance</h2>

<p> <h6 style = "display : inline;padding-left:24px;"> - Filter by colors: </h6><br><br>
<h12 style="padding-left:24px;"></h12>
<input type="checkbox" class="myCheckbox1" value = "E"> Eastern Conference
<input type="checkbox" class="myCheckbox2" value = "W"> Western Conference
</p>

<p> <h6 style = "display : inline;padding-left:24px;"> - Filter by wins%: </h6><br><br>
<h12 style="padding-left:24px;"></h12>
<input type="range" id="myrange" name="myrange" min="0" max="80" value="80" oninput="amount.value=myrange.value">
Win rates > <output name="amount" id="amount" for="myrange"> 80</output> % </p>



<div class="row" style="text-align: center;">
<div class="col-md-6" style="margin-bottom: 15px;">
<div id="legend"><svg width="250" height="45" style="width: 200px; height: 45px;"><g><circle cx="20" cy="14" r="6" fill="hsla(199, 77%, 41%, 0.77)"></circle><circle cx="60" cy="14" r="8" fill="hsla(199, 77%, 41%, 0.77)"></circle><circle cx="100" cy="14" r="10" fill="hsla(199, 77%, 41%, 0.77)"></circle><circle cx="140" cy="14" r="12" fill="hsla(199, 77%, 41%, 0.77)"></circle><circle cx="180" cy="14" r="14" fill="hsla(199, 77%, 41%, 0.77)"></circle></g></svg></div>
The larger the radius of the circle, the higher the scores of the team.
</div>

<div class="col-md-6" style="margin-bottom: 15px;">
<div id="legend2" style="margin-top: 7px; margin-bottom: 3px;"><svg width="300" height="35" style="width: 300px; height: 35px;"><g><circle cx="70" cy="10" r="10" fill="rgba(24, 134, 185, 0.77)"></circle><text x="70" y="35" text-anchor="middle"> 10%</text><circle cx="110" cy="10" r="10" fill="rgba(61, 124, 197, 0.77)"></circle><circle cx="150" cy="10" r="10" fill="rgba(110, 109, 197, 0.77)"></circle><circle cx="190" cy="10" r="10" fill="rgba(155, 86, 181, 0.77)"></circle><circle cx="230" cy="10" r="10" fill="rgba(191, 53, 149, 0.77)"></circle><text x="230" y="35" text-anchor="middle"> 80%</text></g></svg></div>
    The higher the win rate of the team,the more red element is added to the rgba color.
</div>
</div>


</div>

<script src="https://d3js.org/d3.v4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3-tip/0.7.1/d3-tip.min.js"></script>
<script>


//vis body

var margin = { top: 50, right: 50, bottom: 50, left: 50 },
width = 1200 - margin.left - margin.right,
height = 600 - margin.top - margin.bottom;

var svg = d3.select("body")
.append("svg")
.attr("width", width + margin.left + margin.right)
.attr("height", height + margin.top + margin.bottom)
.style("width", width + margin.left + margin.right)
.style("height", height + margin.top + margin.bottom)
.append("g")
.attr("transform", "translate(" + margin.left + "," + margin.top + ")");





var json = {
  "jdata":[]
};




var names = <?php echo json_encode($teamnames, JSON_PRETTY_PRINT) ?>;
var wins = <?php echo json_encode($win, JSON_PRETTY_PRINT) ?>;
var loses = <?php echo json_encode($lose, JSON_PRETTY_PRINT) ?>;
var conferences = <?php echo json_encode($conference, JSON_PRETTY_PRINT) ?>;
var scores = <?php echo json_encode($score, JSON_PRETTY_PRINT) ?>;

var jdata = [];
for (var i = 0; i < wins.length; i++) {
    var obj = {"name" : names[i], "wins" : parseFloat(wins[i]), "loses": parseFloat(loses[i]), "conferences": conferences[i],"scores": scores[i]};
    jdata.push(obj);
}
json["jdata"] = jdata;
//console.log(json.jdata);

var winsScale = d3.scaleLinear()
.domain([0,60])
.range([0,width]);

var losesScale = d3.scaleLinear()
.domain([0,60])
.range([0,height]);


//grid line
var gridlines = d3.axisTop()        // Same orientation as the axis that needs gridlines
.tickFormat(" ")    // (1): Disable the text for the gridlines
.tickSize(-height)  // (2): Extend the tick `width` amount, negative
.tickValues([10, 20, 30, 40, 50, 60])
.scale(winsScale);     // Same scale as the axis that needs gridlines


svg.append("g")
.attr("class", "grid")   // (3): Add a CSS class
.call(gridlines);

var gridlines2 = d3.axisLeft()        // Same orientation as the axis that needs gridlines
.tickFormat(" ")    // (1): Disable the text for the gridlines
.tickSize(-width)  // (2): Extend the tick `width` amount, negative
.scale(losesScale);     // Same scale as the axis that needs gridlines

svg.append("g")
.attr("class", "grid")   // (3): Add a CSS class
.call(gridlines2);



//set axis
var xAxis = d3.axisTop().scale(winsScale);
var yAxis = d3.axisLeft().scale(losesScale);
svg.append("g").call(xAxis)
svg.append("g").call(yAxis)



svg.append("text")
.attr("text-anchor", "end")
.attr("x", width - 5)
.attr("y", 14)
.text("Number of Wins")
.attr("fill", "black")
.attr("font-size", "14px")

// --
svg.append("text")
.attr("text-anchor", "start")
.attr("x", losesScale(50) + 2)
.attr("y", -2)
.text("Number of loses")
.attr("fill", "black")
.attr("font-size", "14px")
.attr("transform", "rotate(90)")

svg.append("rect")
.attr("x", 0)
.attr("y", 0)
.attr("width", width)
.attr("height", height)
.attr("fill", "transparent")


//multiple checkbox succeed!!!!!! just myCheckbox1,myCheckbox2....
d3.select("#myrange").on("input",update);
d3.select(".myCheckbox1").on("change",update);
d3.select(".myCheckbox2").on("change",update);
update();


function update(){
    /*the simplest single checkbox
     
				if(d3.select("#myCheckbox").property("checked")){
                    newdata = json.jdata.filter(function(d,i){return d.conferences == "E";});
                    //newdata.push(choice);
                }
                if(d3.select("#myCheckbox").property("checked")){
                    newdata = json.jdata.filter(function(d,i){return d.conferences == "W";});
                    //newdata.push(choice);
                }
                else{
                    newdata = json.jdata;
                }
    
    
    var newdata = {
        "choices":[]
    };*/
var rate;
d3.selectAll("#myrange").each(function(d){
cb = d3.select(this);
rate= cb.property("value");
});
    
var choices = [];
//multiple check box, just just myCheckbox1,myCheckbox2
d3.selectAll(".myCheckbox1").each(function(d){
cb = d3.select(this);
if(cb.property("checked")){
choices.push(cb.property("value"));
}
});

d3.selectAll(".myCheckbox2").each(function(d){
cb = d3.select(this);
if(cb.property("checked")){
choices.push(cb.property("value"));
}
});

console.log(choices);
if(choices.length > 0){
newdata = json.jdata.filter(function(d,i){return choices.includes(d.conferences);});
} else {
newdata = json.jdata;
}

    
    

    
//json["jdata"] = newdata;
//console.log(json.jdata);
//
var tip =d3.tip()
.attr("class","d3-tip")
.html(function(d){
      //return d["name"];
      var ret;
      if (d.conferences == "W")
      ret =  "Western";
      else if (d.conferences == "E")
      ret = "Eastern";
      
      return "<div>" + d.name + "</div>" +
      '<div  style="text-align: center; margin-top: 5px; padding-top: 5px; margin-bottom: 5px; padding-bottom: 5px; border-top: dotted 1px black; border-bottom: dotted 1px black;">' +
      '<div class="col-xs-6">' +
      '<span style="font-size: 28px;">' + (100*d.wins/(d.wins+d.loses )).toFixed(2) + '%</span><br>' +
      '<span style="font-size: 14px;">' + "Win Rate" + '</span>' +
      '</div>' +
      '<div class="col-xs-6">' +
      '<span style="font-size: 28px;">' + (100*d.loses/(d.wins+d.loses)).toFixed(2) + '%</span><br>' +
      '<span style="font-size: 14px;">' + "Lose Rate" + '</span>' +
      '</div>' +
      '</div>'+
      '<div style="margin-bottom: 5px; padding-bottom: 5px; border-bottom: dotted 1px black;">' +
      "Conference: " + ret +
      ("<br>") +
      '</div>' +
      '<span style="font-size: 12px;"></span>' + "Wins: " + d.wins + "        " +"Loses: "+d.loses;
      
      })
svg.call(tip);




// -- checkbox !!!!!
    // all in "update() function
    // declare "var circle" first to hold only svg.select().data()
    //And "circle.exit().remove();" to remove the unneed

    
var circle = svg.selectAll("circle")
                .data(newdata,function(d){return d;});  //all "circle"
circle.exit().remove();
  
    
//final visualiztion
circle
.enter()
.append("circle")
.on('mouseover', tip.show )
.on('mouseout', tip.hide )
.attr("cy",function(d){
      return losesScale(d.loses);
      })
.attr("cx",function(d){
      return winsScale(d.wins);
      })
.attr("r",function(d){
      if(100*d.wins/(d.wins+d.loses) > parseFloat(rate)){
        console.log(d.name);
        return  Math.pow(d.scores,4)/10000000*1.2;}
      })
.attr("fill", function(d){
      if(100*d.wins/(d.wins+d.loses) > parseFloat(rate)){
      console.log(d.conferences);
      
      if(d.wins>= 50)
        return "rgba(191, 53, 149, 0.77)";
      else if(d.wins>= 40)
      return "rgba(155, 86, 181, 0.77)";
      else if(d.wins>= 30)
      return "rgba(110, 109, 197, 0.77)";
      else if(d.wins>= 20)
      return "rgba(61, 124, 197, 0.77)";
      else if(d.wins>= 10)
      return "rgba(24, 134, 185, 0.77)";
    
      }
      })
;
   
}
    
    

</script>
</body>
</html>

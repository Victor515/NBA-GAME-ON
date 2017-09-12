

<?php
	ob_start();
	session_start();

    
    
	$servername = "localhost";
	$username = "staysimple_dalao1";
	$server_password = "Dalaodalao1";
	$dbname = "staysimple_sometimesnaive_my_DB";

	$con = mysqli_connect($servername, $username, $server_password,$dbname);
	if (mysqli_connect_errno()) {
		die("Could not connect: " . mysqli_connect_error());
	}
    
    $currid = $_SESSION['id'];
    
    $names = array();
	$teamnames = array();
	$points = array();
	$rebounds = array();
    $assists = array();
	$index = 0;
    
	$query = "SELECT * FROM player WHERE Points >10";
	$result = mysqli_query($con, $query);
	if (!$result) {
     		die('Could not select data: ' . mysqli_error($con));
  	}
  	
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
            $names[$index] = $row["Name"];
            $teamnames[$index] = $row["Teamname"];
            $points[$index] = $row["Points"];
			$rebounds[$index] = $row["Rebounds"];
            $assists[$index] = $row["Assists"];
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

.d3-tip.w:after {
width: 10px;
}

.d3-tip.e:after {
width: 10px;
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



<div style = "background-image:url('http://www.pixelstalk.net/wp-content/uploads/2015/12/Stephen-Curry-Wallpaper-HD.jpg');background-size: cover; height: 450px; background-repeat:no-repeat center center">
</div>

<div class="gened_selection">
<br>
<h2 style="padding-left:24px;">Visualization: Player Statistics</h2>

<p> <h6 style = "display : inline; padding-left:24px;"> - Filter by colors: </h6><br>

<h12 style="padding-left:24px;"></h12>
<input type="range" id="myrange1" name="myrange1" min="10" max="30" value="10" oninput="amount1.value=myrange1.value">
Points > <output name="amount1" id="amount1" for="myrange1"> 10</output></p>
<h13 style="padding-left:24px;"></h13>
<input type="range" id="myrange3" name="myrange3" min="0" max="25" value="0" oninput="amount3.value=myrange3.value">
Rebounds > <output name="amount3" id="amount3" for="myrange3"> 0</output></p>
<h14 style="padding-left:24px;"></h14>
<input type="range" id="myrange2" name="myrange2" min="0" max="15" value="0" oninput="amount2.value=myrange2.value">
Assists > <output name="amount2" id="amount2" for="myrange2"> 0</output></p>



<p> <h6 style = "display : inline; padding-left:24px;"> - x - Axis: </h6>
<input name="stat" type="radio" class="myCheckbox1" value = "playerpoint"> By Points
<input name="stat" type="radio" class="myCheckbox3" value = "playerrebound"> By Rebounds
<input name="stat" type="radio" class="myCheckbox2" value = "playerassist"> By Assists </p>


<div class="row" style="text-align: center;">
<div class="col-md-6" style="margin-bottom: 15px;">
<div id="legend"><svg width="250" height="45" style="width: 200px; height: 45px;"><g><circle cx="20" cy="14" r="10" fill="rgba(33, 41, 76,0.6)"></circle><circle cx="60" cy="14" r="10" fill="rgba(33, 41, 76,0.6)"></circle><circle cx="100" cy="14" r="10" fill="rgba(33, 41, 76,0.6)"></circle></g></svg></div>
Players with points, rebounds and assits larger than the level in filter.
</div>

<div class="col-md-6" style="margin-bottom: 15px;">
<div id="legend2" style="margin-top: 7px; margin-bottom: 3px;"><svg width="300" height="35" style="width: 300px; height: 35px;"><g><circle cx="70" cy="10" r="10" fill="rgba(251, 212, 144,0.6)"></circle><text x="70" y="35" text-anchor="middle"> </text><circle cx="110" cy="10" r="10" fill="rgba(251, 212, 144,0.6)"></circle><circle cx="150" cy="10" r="10" fill="rgba(251, 212, 144,0.6)"></circle><text x="230" y="35" text-anchor="middle"> </text></g></svg></div>
Players with points, rebounds and assits not fulfilling the filter conditions.
</div>
</div>






</div>






<script src="https://d3js.org/d3.v4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3-tip/0.7.1/d3-tip.min.js"></script>
<script>


//vis body

var margin = { top: 50, right: 50, bottom: 50, left: 50 },
width = 1200 - margin.left - margin.right,
height = 1200 - margin.top - margin.bottom;

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


var playername = <?php echo json_encode($names, JSON_PRETTY_PRINT) ?>;
var teamname = <?php echo json_encode($teamnames, JSON_PRETTY_PRINT) ?>;
var playerpoint = <?php echo json_encode($points, JSON_PRETTY_PRINT) ?>;
var playerassist = <?php echo json_encode($assists, JSON_PRETTY_PRINT) ?>;
var playerrebound = <?php echo json_encode($rebounds, JSON_PRETTY_PRINT) ?>;

console.log(name);

var jdata = [];
for (var i = 0; i < teamname.length; i++) {
    var obj = {"playername" : playername[i], "teamname": teamname[i], "playerassist":playerassist[i],"playerpoint":playerpoint[i],  "playerrebound": playerrebound[i]};
    jdata.push(obj);           // an org error: name conflict!! use different name "playername"!
}
json["jdata"] = jdata;

console.log(jdata);

//set the svg ooutside the update function!! Then the grid line will not repetitvely appears



// quantitative and categorical data : 2 types of data







//multiple checkbox succeed!!!!!! just myCheckbox1,myCheckbox2....


d3.select("#myrange1").on("input",update);
d3.select("#myrange2").on("input",update);
d3.select("#myrange3").on("input",update);
d3.select(".myCheckbox1").on("change",update);
d3.select(".myCheckbox2").on("change",update);
d3.select(".myCheckbox3").on("change",update);

update();
//update(y);




//finally the function update, this is where the final visualization lives because it depend on the checkbox, so should be in the function
function update(){
svg.selectAll("*").remove(); // got it !!!! clear the svg everytime first for updating and drawing again
    
   
   
//1.reload the data
//multiple check box, just just myCheckbox1,myCheckbox2
var mystat = "playerpoint";
var xx;
var yy;
var zz;
    
d3.selectAll("#myrange1").each(function(d){
cb = d3.select(this);
xx= cb.property("value");
});
    
d3.selectAll("#myrange2").each(function(d){
cb = d3.select(this);
yy = cb.property("value");
});
    
d3.selectAll("#myrange3").each(function(d){
cb = d3.select(this);
zz = cb.property("value");
});
  
d3.selectAll(".myCheckbox1").each(function(d){
cb = d3.select(this);
if(cb.property("checked")){
mystat = cb.property("value");
}
});

d3.selectAll(".myCheckbox2").each(function(d){
cb = d3.select(this);
if(cb.property("checked")){
mystat = cb.property("value");
}
});
    
d3.selectAll(".myCheckbox3").each(function(d){
cb = d3.select(this);
if(cb.property("checked")){
mystat = cb.property("value");
}
});
/*
console.log(choices);
if(choices.length > 0){
newdata = json.jdata.filter(function(d,i){return choices.includes(d.conferences);});
} else {
newdata = json.jdata;
}
console.log(newdata);
*/
    
    
    var mystat1;
    var mystat2;
    var title1;
    var title2;
    var xrange = 35;
    if (mystat == "playerpoint"){
        mystat1 = "playerrebound";
        mystat2 = "playerassist";
        title1 = "Rebounds";
        title2 = "Assists";
        xrange = 35;
        //scale
        var xScale = d3.scaleLinear()
        .domain([0,xrange])
        .range([0,width]);
        
        var teamScale = d3.scalePoint()
        .domain(teamname)
        .range([0,height]);
        //grid line
        var gridlines = d3.axisTop() // Same orientation as the axis that needs gridlines
        .tickFormat(" ")    // (1): Disable the text for the gridlines
        .tickSize(-height)  // (2): Extend the tick `width` amount, negative
        .tickValues([5, 10, 15, 20, 25, 30, 35])
        .scale(xScale);     // Same scale as the axis that needs gridlines
    }
    else if (mystat == "playerrebound"){
        mystat1 = "playerpoint";
        mystat2 = "playerassist"
        title1 = "Points";
        title2 = "Assists";
        xrange = 16;
        //scale
        var xScale = d3.scaleLinear()
        .domain([0,xrange])
        .range([0,width]);
        
        var teamScale = d3.scalePoint()
        .domain(teamname)
        .range([0,height]);
        //grid line
        var gridlines = d3.axisTop() // Same orientation as the axis that needs gridlines
        .tickFormat(" ")    // (1): Disable the text for the gridlines
        .tickSize(-height)  // (2): Extend the tick `width` amount, negative
        .tickValues([4, 8,12,16, 20])
        .scale(xScale);     // Same scale as the axis that needs gridlines
    }
    else if (mystat == "playerassist"){
        mystat1 = "playerpoint";
        mystat2 = "playerrebound"
        title1 = "Points";
        title2 = "Rebounds";
        xrange = 12;
        //scale
        var xScale = d3.scaleLinear()
        .domain([0,xrange])
        .range([0,width]);
        
        var teamScale = d3.scalePoint()
        .domain(teamname)
        .range([0,height]);
        //grid line
        var gridlines = d3.axisTop() // Same orientation as the axis that needs gridlines
        .tickFormat(" ")    // (1): Disable the text for the gridlines
        .tickSize(-height)  // (2): Extend the tick `width` amount, negative
        .tickValues([3, 6, 9, 12])
        .scale(xScale);     // Same scale as the axis that needs gridlines
    }
    
    
    //gridline2 and css
    svg.append("g")
    .attr("class", "grid")   // (3): Add a CSS class
    .call(gridlines);
    
    var gridlines2 = d3.axisLeft()  // Same orientation as the axis that needs gridlines
    .tickFormat(" ")    // (1): Disable the text for the gridlines
    .tickSize(-width)  // (2): Extend the tick `width` amount, negative
    .scale(teamScale);     // Same scale as the axis that needs gridlines
    
    
    svg.append("g")
    .attr("class", "grid")   // (3): Add a CSS class
    .call(gridlines2);
    
    //set axis
    var xAxis = d3.axisTop().scale(xScale);
    var yAxis = d3.axisLeft().scale(teamScale);
    svg.append("g").call(xAxis)
    svg.append("g").call(yAxis)
    
    
    //set axis text
    svg.append("text")
    .attr("text-anchor", "end")
    .attr("x", width - 5)
    .attr("y", 14)
    .text("Average " + mystat + "s" )
    .attr("fill", "black")
    .attr("font-size", "14px")
    
    svg.append("rect")
    .attr("x", 0)
    .attr("y", 0)
    .attr("width", width)
    .attr("height", height)
    .attr("fill", "transparent")
    .on("click", function() {
        tip.hide();
        svg.selectAll(".gened_circle")
        .transition()
        .style("opacity",1);
        })
    


//2. draw tips
var tip =d3.tip()
.attr("class","d3-tip")
.html(function(d){
      //return d["name"];
      
      return "<div>" + d.playername + "</div>" +
      '<div  style="text-align: center; margin-top: 5px; padding-top: 5px; margin-bottom: 5px; padding-bottom: 5px; border-top: dotted 1px black; border-bottom: dotted 1px black;">' +
      '<div class="col-xs-6">' +
      '<span style="font-size: 28px;">' + d[mystat1] + '</span><br>' +
      '<span style="font-size: 14px;">' + title1 + '</span>' +
      '</div>' +
      '<div class="col-xs-6">' +
      '<span style="font-size: 28px;">' + d[mystat2] + '</span><br>' +
      '<span style="font-size: 14px;">' + title2 + '</span>' +
      '</div>' +
      '</div>'+
      '<div  style="margin-bottom: 5px; padding-bottom: 5px; border-bottom: dotted 1px black;">' +
      "Team: " + d.teamname+
      ("<br>") +
      '</div>'
      /*+
      '<span style="font-size: 12px;"></span>' + "Wins: " + d.wins + "        " +"Loses: "+d.loses;
      */
      })
svg.call(tip);




// 3. checkbox and final visualiztion!!!!!
// all in "update() function
// declare "var circle" first to hold only svg.select().data()
//And "circle.exit().remove();" to remove the unneed
var circle = svg.selectAll("circle")
                .data(json.jdata,function(d){return d;});  //all "circle"
circle.exit().remove();

circle
.enter()
.append("circle")
.on('mouseover',tip.show)
.on('mouseout',tip.hide)
.attr("cx",function(d){
      return xScale(d[mystat]);
      })
.attr("cy",function(d){
      return teamScale(d.teamname);
      })
.attr("r", 15)
.attr("fill",function(d){
      if((d.playerassist > parseInt(yy)) && (d.playerpoint > parseInt(xx))  && (d.playerrebound>parseInt(zz))){
        return "rgba(33, 41, 76,0.6)";
      }
      else{
        return "rgba(251, 212, 144,0.6)";
      }
      });

    console.log(xx);
    console.log(yy);
    console.log(zz);
}
    
    

</script>
</body>
</html>

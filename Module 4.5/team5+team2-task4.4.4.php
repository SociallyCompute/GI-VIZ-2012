<!--
Suggestion 1: Allow users to select the color they want to fill for the bars
Sample code: (Before JS)
<select name="selection" id="selection">
    <option value="1">Please Select Color</option>
    <option value="2" onclick="document.getElementById(selection).value = 2" >Red</option>
    <option value="3" onclick="document.getElementById(selection).value = 3">Blue</option>
    <option value="4" onclick="document.getElementById(selection).value = 4">Green</option>
</select>

(In JS)
//This in place of “var color = function(id) { return '#00b3dc' };”
    var color;
 if (document.getElementById("selection").value = 1)
        {
           color = function(id) {
             return 'black';
            }
        }
      else if (document.getElementById("selection").value = 2)
      {
          color = function(id) {
              return 'red';
          }

      }
     else if (document.getElementById("selection").value = 3)
      {
            color = function(id) {
              return 'blue';
          }
      }

      else
      {
          color = function(id) {
              return 'green';
          }
      }

Suggestion 2: Clean up the code and take out unnecessary comments

We took out comments such as:
1.
//Ticks
/* Matt - we don't want the ticks so comment them out for now
	var rules = vis.selectAll("g.rule")
    	.data(x.ticks(num_ticks))
    	.enter()
    	.append("svg:g")
    	.attr("transform", function(d) {
        	return "translate(" + (chart_left + x(d)) + ")";
    	});

	rules.append("svg:line")
    	.attr("class", "tick")
    	.attr("y1", chart_top)
    	.attr("y2", chart_top + 4)
    	.attr("stroke", "black");

	rules.append("svg:text")
    	.attr("class", "tick_label")
    	.attr("text-anchor", "middle")
    	.attr("y", chart_top)
    	.text(function(d){
        	return d;
    	});

	var bbox = vis.selectAll(".tick_label").node().getBBox();
	vis.selectAll(".tick_label")
    	.attr("transform", function(d){
        	return "translate(0," + (bbox.height) + ")";
    	});
*/

2.
//maximum of data you want to use
	var data_max = 7000; // Aaarrgg noo!!  <--- we took this comment out

3. // Dont go overboard with chaining methods, it gets confusing  <-- we changed this up a bit
	vis.append("svg:g")
    	.attr("id", "barchart")
    	.attr("class", "barchart");

Suggestion 3: Simplify some of the code
Sample: Suggstion 3: simplify code:

Ex. 1:  reading the external file for data:
While the method Team 2 used worked, they could have implemented their code in a much simpler way for better readability. One example is to add the headings to the columns in the csv file and then use the below d3 function.

d3.csv("catchingfire-hashtag-timeline.csv", function(csv) {
    var data = [];
   	 csv.forEach(function(row) {
   		 var d = {
       		 "zzz" : parseInt(row.zzz), //Match column definition/heading
       		 "xxx" : row.xxx,  //Match column definition/heading
       		 "yyy" : row.yyy  //Match column definition/heading
   		 };
   		 data.push(d);
   		 return data;


});

Ex. 2 Change this
var left_margin = 80;
var right_margin = 80;
var top_margin = 30;
var bottom_margin = 0;

to this: var margin {left:80, right: 80, top:30, bottom:0},


Ex. 3
// Really hard to read  - this could be explained better
var x = d3.scale.linear()
.domain([0, data_max])---------domain([0, data.length])
.range([0, w - ( left_margin + right_margin ) ]);

var y = d3.scale.ordinal()
.domain(d3.range(data.length))----------domain([0, ])
.rangeBands([bottom_margin, h - top_margin], .5);



      =================================================================================================
Modification: We decided to change the bar color to white and move the labels into the bars. 

The following code was changed:
1.
.bar rect {
            fill: black; /*changed from black to white*/
            stroke: black;
        }


2.
         labels = vis.selectAll("g.bar")
        .append("svg:text")
        .attr("class", "value")
        .attr("x", function(d){
            return x(d.value) + right_margin + 10; // changed 10 to -40
        })


-->

<html>
<head>
    <title>Team 2 Bar Chart</title>
    <h1>Catching Fire Timeline (April, 2012)</h1>
    <script type="text/javascript" src="http://mbostock.github.com/d3/d3.js?2.1.3"></script>
    <script type="text/javascript" src="http://mbostock.github.com/d3/d3.geom.js?2.1.3"></script>
    <script type="text/javascript" src="http://mbostock.github.com/d3/d3.layout.js?2.1.3"></script>
    <style type="text/css">
        .bar rect {
            fill: white; /*changed from black*/
            stroke: black;
        }

        .label {
            font-family: Verdana;
            font-size: 8pt;
            color: gray;
            fill-opacity: .6;
        }

        .value {
            font-family: Verdana;
            font-size: 8pt;
            color: gray;
            fill-opacity: .6;
        }

        .tick_label {
            font-size: 8pt;
            font-family: Verdana;
            color: gray;
            fill-opacity: .6;
        }
    </style>
</head>
<body>
<script type="text/javascript">

    <?php

    $datafile = 'catchingfirehashtagtimeline.csv';

    $filehandle = fopen("$datafile", "r") or die ('Cannot open the csv file!');

    $jsdata    = '';
    $value     = '';
    $label     = '';
    $catchfire = '';

    $elementstring = array();

    while (($linedata = fgetcsv($filehandle, 1500, ",")) !== FALSE) {

        $value     = $linedata[0];  // the numeric value
        $catchfire = $linedata[1]; // Not needed
        $label     = $linedata[2]; // the date

        $elementstring[] = '{"label":"'.$label.'", "value":'.$value.'}';

    }

    $arrayelements = implode(",", $elementstring);

    $jsdata = '[' . $arrayelements . '];';

    fclose($filehandle);

    echo 'var data = ' . $jsdata;
    ?>


    //maximum of data you want to use
    var data_max = 7000;

    //number of tickmarks to use
    var num_ticks = 30;

    //margins
    var left_margin = 80;
    var right_margin = 80;
    var top_margin = 30;
    var bottom_margin = 0;


    var w = 1000;//width
    var h = 1000;//height
    var color = function(id) { return '#00b3dc' };


    var x = d3.scale.linear()
        .domain([0, data_max])
        .range([0, w - ( left_margin + right_margin ) ]);

    var y = d3.scale.ordinal()
        .domain(d3.range(data.length))
        .rangeBands([bottom_margin, h - top_margin], .5);


    var chart_top = h - y.rangeBand()/2 - top_margin;
    var chart_bottom = bottom_margin + y.rangeBand()/2;
    var chart_left = left_margin;
    var chart_right = w - right_margin;

    /*
     *  Setup the SVG element and position it
     */
    var vis = d3.select("body")
        .append("svg:svg")
        .attr("width", w)
        .attr("height", h);


    vis.append("svg:g")
        .attr("id", "barchart")
        .attr("class", "barchart");

    var bars = vis.selectAll("g.bar")
        .data(data)
        .enter()
        .append("svg:g")
        .attr("class", "bar")
        .attr("transform", function(d, i) {
            return "translate(0, " + y(i) + ")";
        });

    bars.append("svg:rect")
        .attr("x", right_margin)
        .attr("width", function(d) {
            return (x(d.value));
        })
        .attr("height", y.rangeBand())
        .attr("fill", color(0))
        .attr("stroke", color(0));


    //Labels
    var labels = vis.selectAll("g.bar")
        .append("svg:text")
        .attr("class", "label")
        .attr("x", 0)
        .attr("text-anchor", "right")
        .text(function(d) {
            return d.label;
        });

    var bbox = labels.node().getBBox();
    vis.selectAll(".label")
        .attr("transform", function(d) {
            return "translate(0, " + (y.rangeBand()/2 + bbox.height/4) + ")";
        });


    labels = vis.selectAll("g.bar")
        .append("svg:text")
        .attr("class", "value")
        .attr("x", function(d){
            return x(d.value) + right_margin + -40; // changed from 10 to -40
        })
        .attr("text-anchor", "left")
        .text(function(d){
            return "" + d.value;
        });

    bbox = labels.node().getBBox();
    vis.selectAll(".value")
        .attr("transform", function(d){
            return "translate(0, " + (y.rangeBand()/2 + bbox.height/4) + ")";
        });

    //Axes
    vis.append("svg:line")
        .attr("class", "axes")
        .attr("x1", chart_left)
        .attr("x2", chart_left)
        .attr("y1",chart_bottom)
        .attr("y2", chart_top)
        .attr("stroke", "black");

    vis.append("svg:line")
        .attr("class", "axes")
        .attr("x1", chart_left)
        .attr("x2", chart_right)
        .attr("y1", chart_top)
        .attr("y2", chart_top)
        .attr("stroke", "black");
</script>
</body>
</html>
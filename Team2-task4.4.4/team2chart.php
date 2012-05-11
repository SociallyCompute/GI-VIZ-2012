<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mcarey
 * Date: 5/10/12
 * Time: 9:29 PM
 * To change this template use File | Settings | File Templates.
 */


?>


<!-- Annotated javascript available at http://enja.org/code/tuts/d3/bar -->
<!-- Code walkthrough screencast available at -->
<html>
<head>
    <title>Team 2 Bar Chart</title>
    <script type="text/javascript" src="http://mbostock.github.com/d3/d3.js?2.1.3"></script>
    <script type="text/javascript" src="http://mbostock.github.com/d3/d3.geom.js?2.1.3"></script>
    <script type="text/javascript" src="http://mbostock.github.com/d3/d3.layout.js?2.1.3"></script>
    <style type="text/css">
        .bar rect {
            fill: black;
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
// MC - not very elegent but it gets the job done
$datafile = 'catchingfirehashtagtimeline.csv';

$filehandle = fopen("$datafile", "r") or die ('Cannot open the csv file!');

$jsdata    = '';
$value     = '';
$label     = '';
$catchfire = '';

$elementstring = array();

while (($linedata = fgetcsv($filehandle, 1500, ",")) !== FALSE) {

    $value     = $linedata[0];  // the numeric value
    $catchfire = $linedata[1]; // is this even needed?
    $label     = $linedata[2]; // the date

    $elementstring[] = '{"label":"'.$label.'", "value":'.$value.'}';

}

$arrayelements = implode(",", $elementstring);

$jsdata = '[' . $arrayelements . '];';

fclose($filehandle);

echo 'var data = ' . $jsdata;
?>

/*MC - this was the original hard coded data array
    var data = [{"label":"1990", "value":16},  // Align things
        {"label":"1991", "value":56},
        {"label":"1992", "value":7},
        {"label":"1993", "value":77},
        {"label":"1994", "value":22},
        {"label":"1995", "value":16}]; // No trailing comma!
*/
    //maximum of data you want to use
    var data_max = 7000; // Aaarrgg noo!!

    //number of tickmarks to use
    var num_ticks = 30;

    //margins
    var left_margin = 80;
    var right_margin = 80;
    var top_margin = 30;
    var bottom_margin = 0;


    var w = 1000;                        //width
    var h = 1000;                        //height
    var color = function(id) { return '#00b3dc' };

    // Really hard to read
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

    // Dont go overboard with chaining methods, it gets confusing
    vis.append("svg:g")
        .attr("id", "barchart")
        .attr("class", "barchart");


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
    // Be consistent with indentation
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
            return x(d.value) + right_margin + 10;
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
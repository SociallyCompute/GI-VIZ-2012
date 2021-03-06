<!--
=============
Team 4 Review
=============

Modification #1 - Dynamic sizing and center alignment:
------------------------------------------------------
    CSS Change:
        #barChart { /* CSS for bar chart DIV  */
        margin-left:auto;
        margin-right:auto;
        width:60%;
        border: 1px solid black;
        }

    HTML Change:
        <div id="barChart">
            <h1>#catchingfire Twitter Activity by Day</h1><br/>

            <h2>Colin Smith and Domenic Rocco</h2>

        </div>

    JS Change:
        var browserHeight = window.innerHeight-150; //Pad the height
        var browserWidth = window.innerWidth*.60; // 60% of the width, per our DIV
        var margin = {top:30, right:75, bottom:10, left:75},
            width = browserWidth - margin.right - margin.left,  //Point to new variable
            height = browserHeight - margin.top - margin.bottom; //Point to new variable
        ...
        var svg = d3.select("#barChart").append("svg")  // Instead of appending to the body tag, we give the SVG its own DIV



Suggestion #1 - Add some color to the bars depending on the values within the CSV data:
---------------------------------------------------------------------------------------
    bar.append("rect")
    .attr("width", function (d) {
    return x(d.value);
    })
    .style("fill",
    function(d) {
    if(d.value>4000) { return "#FF9999";}
    if(d.value>2000) { return "#FFFF80";}
    if(d.value>0) { return "#ADEBAD";}
    })
    .attr("height", y.rangeBand());



Suggestion #2 - Use CSS to draw bars instead of SVG (per the D3 Playground's approach):
---------------------------------------------------------------------------------------
    var transitionDurationMS = 200;
    var divs = d3.select("#playground").selectAll("div").data(data);


    divs.enter().append("div")
    .attr("class", "bar")
    .text(
    function (data) {
    return data.bar;
    }
    )
    .style("opacity", 0)
    .style("background",
    function(data) {
    if(data.bar>4000) { return "#FF9999";}
    if(data.bar>2000) { return "#FFFF80";}
    if(data.bar>0) { return "#ADEBAD";}
    })
    .append("h2");

    d3.selectAll("h2")
    .text(
    function (data) {
    return data.date;
    }
    )
    .style("color", "black")
    .attr("style", function(data) { return "position:relative; top:"+data.bar*.09+"px"; });

    divs.exit().transition().duration(transitionDurationMS)
    .style("opacity", 0)
    .remove();

    divs.transition().duration(transitionDurationMS)
    .style("opacity",1)
    .style("height", function(d){ return d.bar*.09+"px" })
    .text(ƒ('toFixed'));



Suggestion #3 - Add more ticks to the x axis since data falls mostly under 2000:
-------------------------------------------------------------------------------
    var xAxis = d3.svg.axis()
            .scale(x)
            .ticks(20)
            .orient("top")
            .tickSize(-height);


-->

<!DOCTYPE html>
<html>
<head>
    <title>Team One Bar Chart</title>
    <script type="text/javascript" src="d3.v2.js?2.8.1"></script>
    <style type="text/css">

        body {
            font: 10px sans-serif;
        }

        .bar rect {
            fill: steelblue;
        }

        .bar text.value {
            fill: white;
        }

        .axis {
            shape-rendering: crispEdges;
        }

        .axis path {
            fill: none;
        }

        .x.axis line {
            stroke: blue;
            stroke-opacity: .5;
        }

        .y.axis path {
            stroke: black;
        }

        #barChart { /* CSS for bar chart DIV  */
            margin-left:auto;
            margin-right:auto;
            width:60%;
            border: 1px solid black;
        }

    </style>
</head>
<body>


<div id="barChart"> <!-- Bar chart SVG div -->
    <h1>#catchingfire Twitter Activity by Day</h1><br/>

    <h2>Colin Smith and Domenic Rocco</h2>

</div>

<script type="text/javascript">
    var browserHeight = window.innerHeight-150; //Pad the height
    var browserWidth = window.innerWidth*.60; // 60% of the width, per our DIV
    var margin = {top:30, right:75, bottom:10, left:75},
        width = browserWidth - margin.right - margin.left,  //Point to new variable
        height = browserHeight - margin.top - margin.bottom; //Point to new variable

    var format = d3.format(",.0f");

    var x = d3.scale.linear()
        .range([0, width],5);

    var y = d3.scale.ordinal()
        .rangeRoundBands([0, height], .1);

    var xAxis = d3.svg.axis()
        .scale(x)
        .ticks(20)
        .orient("top")
        .tickSize(-height);

    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left")
        .tickSize(0);

    var svg = d3.select("#barChart").append("svg")  // Instead of appending to the body tag, we give the SVG its own DIV
        .attr("width", width + margin.right + margin.left)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
    //Changed csv file to reflect provided file- colin
    // added "value" and "date" identifiers to columns in csv file - colin
    d3.csv("catchingfire-hashtag-timeline.csv", function (data) {

        // Parse numbers.  Removed sort by value to organize data by date. - Colin
        data.forEach(function (d) {
            d.value = +d.value;
        });

        // Set the scale domain.
        x.domain([0, d3.max(data, function (d) {
            return d.value;
        })]);
        y.domain(data.map(function (d) {
            return d.date;
        }));

        var bar = svg.selectAll("g.bar")
            .data(data)
            .enter().append("g")
            .attr("class", "bar")
            .attr("transform", function (d) {
                return "translate(0," + y(d.date) + ")";
            });

        bar.append("rect")
            .attr("width", function (d) {
                return x(d.value);
            })
            .attr("height", y.rangeBand());

        bar.append("text")
            .attr("class", "value")
            .attr("x", function (d) {
                return x(d.value);
            })
            .attr("y", y.rangeBand() / 2)
            .attr("dx", -3)
            .attr("dy", ".35em")
            .attr("text-anchor", "end")
            .text(function (d) {
                return format(d.value);
            });

        svg.append("g")
            .attr("class", "x axis")
            .call(xAxis);

        svg.append("g")
            .attr("class", "y axis")
            .call(yAxis);
    });

</script>
</body>
</html>
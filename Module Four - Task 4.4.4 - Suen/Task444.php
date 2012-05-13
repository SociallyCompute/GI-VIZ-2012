<?php
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<!/**
 * Drexel University
 * INFO 655 Intro to Web Programming
 * User: Tze Fung Suen
 *
 */>

<html>
<head>
    <script type="text/javascript" src="d3.v2.js?2.8.1"></script>
</head>
<body>

<h1>Module 4.4.4 - Displaying a barchat base data in CSV file</h1>

<div id="barChart"></div>
<script type="text/javascript">

//reading in the csv file
    d3.csv("catchingfire-hashtag-timeline.csv", function(csvFile) {
        var data = [];
        csvFile.forEach(function(f) {
            var dataRow = {
                "hashtag" : f.Hashtag,
                "date" : f.Date
            };

            data.push(dataRow);
            return data;
        });

//base on the bar demo from http://www.recursion.org/d3-for-mere-mortals/

		//modified the variables to make it look better
        var barWidth = 80;
        var width = (barWidth + 10) * data.length;
        var height = 500;
        var padding = 40;

		//changed various calls to reflect change in name to hashtag and date

        var x = d3.scale.linear().domain([0, data.length]).range([0, width]);
		//multipled by a fraction to make the chart fit onscreen
        var y = d3.scale.linear().domain([0, d3.max(data, function(datum) { return datum.hashtag*1.2; })]).rangeRound([0, height]);

        var barDemo = d3.select("#barChart")
            .append("svg:svg")
            .attr("width", width)
            .attr("height", height + padding);

        barDemo.selectAll("rect")
            .data (data)
            .enter()
            .append("svg:rect")
            .attr("x", function(datum,index) { return x(index) ;})
            .attr("y", function(datum) {return height - y(datum.hashtag) ;})
            .attr("height", function(datum) { return y(datum.hashtag) ;})
            .attr("width", barWidth)
            .attr("fill", "2d578b");

        barDemo.selectAll("text")
            .data(data)
            .enter()
            .append("svg:text")
            .attr("x", function(datum, index) { return x(index) + barWidth;})
            .attr("y", function(datum) { return height - y(datum.hashtag) ;})
            .attr("dx", -barWidth/2)
            .attr("dy", "1.2em")
            .attr("text-anchor", "middle")
            .text(function(datum) { return datum.hashtag})
            .attr("fill", "white");

        barDemo.selectAll("text.yAxis")
            .data(data)
            .enter()
            .append("svg:text")
            .attr("x", function(datum, index) { return x(index) + barWidth;})
            .attr("y", height + padding)
            .attr("dx", -barWidth/2)
            .attr("text-anchor", "middle")
            .attr("style", "font-size: 12; font-family: Helvetica, sans-serif")
            //show the date as the X-axis
            .text(function(datum) { return datum.date})
            .attr("class", "yAxis");

    });
</script>

</body>
</html>
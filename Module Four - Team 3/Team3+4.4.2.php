<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<!/**
* File Name:
* Drexel University
* INFO 655 Intro to Web Programming
* User: Tom Grigas
* User: Yeo Kadodjomo
* User: Anthony Tang
* User: Benjamin Toll
*
* Date: 5/7/12
* Time: 3:39 PM
*
*/>
<html>
<head>
    <script type="text/javascript" src="../d3-lib/d3.v2.js"></script>
</head>
<body>
<h1> Data read from csv a file</h1>

<div id="vizTable"></div>
<script type="text/javascript">

    d3.text("Team3+4.4.2+DataFile.csv", function (datasetText) {
        var parsedCSV = d3.csv.parseRows(datasetText);

        var sampleHTML = d3.select("#vizTable")
            .append("table")
            .style("border-collapse", "collapse")
            .style("border", "2px black solid")

            .selectAll("tr")
            .data(parsedCSV)
            .enter().append("tr")

            .selectAll("td")
            .data(function (d) {
                return d;
            })
            .enter().append("td")
            .style("border", "1px black solid")
            .style("padding", "5px")
            .on("mouseover", function () {
                d3.select(this).style("background-color", "aliceblue")
            })
            .on("mouseout", function () {
                d3.select(this).style("background-color", "white")
            })
            .text(function (d) {
                return d;
            })
            .style("font-size", "12px");
    });
</script>
<h1> Data read from array inside the program</h1>

<div id="bar-demo"></div>

<script type="text/javascript">


    var data = [
        {year:2002, books:100},
        {year:2003, books:20},
        {year:2004, books:80},
        {year:2005, books:10},
        {year:2006, books:30},
        {year:2007, books:43},
        {year:2008, books:41},
        {year:2009, books:44},
        {year:2010, books:35}
    ];

    var barWidth = 40;
    var width = (barWidth + 10) * data.length;
    var height = 200;
    var padding = 30;

    var x = d3.scale.linear().domain([0, data.length]).range([0, width]);
    var y = d3.scale.linear().domain([0, d3.max(data, function (datum) {
        return datum.books;
    })]).rangeRound([0, height]);

    var barDemo = d3.select("#bar-demo")
        .append("svg:svg")
        .attr("width", width)
        .attr("height", height + padding);

    barDemo.selectAll("rect")
        .data(data)
        .enter()
        .append("svg:rect")
        .attr("x", function (datum, index) {
            return x(index);
        })
        .attr("y", function (datum) {
            return height - y(datum.books);
        })
        .attr("height", function (datum) {
            return y(datum.books);
        })
        .attr("width", barWidth)
        .attr("fill", "red");

    barDemo.selectAll("text")
        .data(data)
        .enter()
        .append("svg:text")
        .attr("x", function (datum, index) {
            return x(index) + barWidth;
        })
        .attr("y", function (datum) {
            return height - y(datum.books);
        })
        .attr("dx", -barWidth / 2)
        .attr("dy", "1.2em")
        .attr("text-anchor", "middle")
        .text(function (datum) {
            return datum.books
        })
        .attr("fill", "blue");

    barDemo.selectAll("text.yAxis")
        .data(data)
        .enter()
        .append("svg:text")
        .attr("x", function (datum, index) {
            return x(index) + barWidth;
        })
        .attr("y", height + padding)
        .attr("dx", -barWidth / 2)
        .attr("text-anchor", "middle")
        .attr("style", "font-size: 12; font-family: Helvetica, sans-serif")
        .text(function (datum) {
            return datum.year
        })
        .attr("class", "yAxis");

</script>
</body>
</html>
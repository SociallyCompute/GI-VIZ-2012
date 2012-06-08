<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <style type="text/css">
        body { margin: 0; padding: 0; font-family: Verdana; }
        #Header {
            font-size: 18px;
            background-color: #000;
            color: #FFF;
            padding: 10px;
            margin-bottom: 10px;
            font-family: Verdana;
            font-size: 12px;
        }
        #viz { margin-left: auto; margin-right: auto; width: 95%; background-color: #EEE; font-size: 8px; font-family: Verdana; overflow: auto; padding: 20px 10px 20px 10px; }
        .bar {
            display: inline-block;
            width: 20px;
            margin-right: 3px;
            background: #369; color:white;
            border:4px outset #69c;
            border-bottom:1px solid #000;
            border-radius:4px 4px 0 0;
            vertical-align:bottom;
            font-family:sans-serif; font-size:10px
        }
    </style>

    <script type="text/javascript" src="http://mbostock.github.com/d3/d3.js"></script>
    <script type="text/javascript">

        d3.csv("catchingfire-hashtag-timeline.csv", function(Counts) {

            data=Counts;
            data.forEach(function(data) {
                data.Counts = parseFloat(data.Counts);
            });

            var	columns=["Date", "Counts"];
            var barWidth = 30;
            var	width = (barWidth + 25) * data.length;
            var	height = 300;
            var	padding = 25;   //altered height, padding, width to create more visual difference between bars of different value - Team 1
            var	x = d3.scale.linear().domain([0, data.length]).range([0, width]);
            var y = d3.scale.linear().domain([0, d3.max(data, function(datum) { return datum.Counts; })]).rangeRound([0, height]);

            var sampleSVG = d3.select("#viz")
                .append("svg:svg")
                .attr("width", width)
                .attr("height", height+padding);

            sampleSVG.selectAll("rect")
                .data(data)
                .enter()
                .append("svg:rect")
                .attr("x", function(datum, index) { return x(index); })
                .attr("y", function(datum) { return height - y(datum.Counts); })
                .attr("height", function(datum) { return y(datum.Counts); })
                .attr("width", barWidth)
                .attr("fill", "2d578b");

            sampleSVG.selectAll("text")
                .data(data)
                .enter()
                .append("svg:text")
                .attr("x", function(datum, index) { return x(index) + barWidth; })
                .attr("y", function(datum) { return height - y(datum.Counts); })
                .attr("dx", -barWidth/2)
                .attr("dy", "1.2em")
                .attr("text-anchor", "middle")
                .text(function(datum) { return datum.Counts;})
                .attr("fill", "white");

            sampleSVG.selectAll("text.yAxis")
                .data(data)
                .enter()
                .append("svg:text")
                .attr("x", function(datum, index) { return x(index) + barWidth; })
                .attr("y", height+padding)
                .attr("dx", -barWidth/2)
                .attr("text-anchor", "middle")
                .attr("style", "font-size: 12; font-family: Helvetica, sans-serif")
                .text(function(datum) { return datum.Date;})
                .attr("class", "yAxis");
        })
/*
Suggestions
It seems our groups took a similar approach in parsing the CSV file.
Since no column names were provided in the file itself, we added them
to the CSV manually. One suggestion for both of our groups would be to
implement an alternative solution where there are no modifications made
to the CSV file. The parseRows method, according to the D3 API, seems to
accomplish this. It’s used to parse CSV rows when there are no columns specified.
We were unsure how to implement this ourselves, but I would love to see the solution.

Now that you have a working example, it would be advisable to add some
comments throughout. To comment Javascript, you simply prefix a single
line comment with “//” or surround a multiline comment with slashes and stars.

It would be interesting to add a Counts total to the document. For example,
one way to do this outside of D3 would be to use JQuery. $(".Counts").innerHTML
could be used to pull the values of each Counts bar. You could then parse these
values as numbers and then add them using a loop.

Finally, the bar chart is displayed as a scrolling div.  When visualizing data,
it is not always possible to view all data on the screen at once.  Since it IS
possible in this case, we want to take advantage.  Increasing the height while
decreasing width, barwidth, and padding creates more visual difference between
the bars while also allowing all the data to be seen on one page.  We also
recommend realigning the div so that it is centered on the page.
*/

    </script>
</head>
<body>
<div id="Header">INFO 655, Module 4.4.4</div>
<strong>Hashtag Counts</strong>
<div id="viz"></div>
</body>
</html>
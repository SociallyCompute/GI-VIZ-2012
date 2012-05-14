<?
/*From Tze Fung Suen:
 * Nice touch with the heading and the background color,
 * I hadn’t thought of that in my visualization.
 * One issue I found in the code was that data was never
 * explicitly declead, but overall, great job.
 * You guys took care of the scaling problem much more
 * elegantly than I did.
 * Should also really put in some comment to see which
 * are of the code does what; saves time and trobule.
 * Some improvement to consider:
 *
 *  •	Perhaps adding fields where you can upload
 *      a CSV file and then visualize it on the site,
 *      this way, this page have functionality
 *      rather than just being sample codes.
 *
 *  •	Add a method to sort the data by hashtags or
 *      by date, this can be done by building two data
 *      array and changing between the two for the visitation.
 *
 *  •	Although the colors looks great with the dark bar,
 *      light background and light color words, might you
 *      consider applying color theory to make your
 *      visualization more encouraging for people to read;
 *      a great site that I have use that select all
 *      the color for me is http://www.colorhunter.com/.
 *
 * I added a conditional so that when the hashag count is above
 * 3000, the fill color is red instead of blue
 */
?>
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
		#viz { background-color: #EEE; font-size: 8px; font-family: Verdana; overflow: auto; padding: 20px 10px 20px 10px; }
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
			var barWidth = 40;
			var	width = (barWidth + 30) * data.length;
			var	height = 200;
			var	padding = 30;
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
                //change the color so that if Count is above 3000, it highlights in red
				.attr("fill", function(datum) {
                                    if (datum.Counts > 3000)
                                        return "#A52A2A"
                                    return "#2d578b";
                                });
	
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
	</script>
</head>
<body>
<div id="Header">INFO 655, Module 4.4.4</div>
<strong>Hashtag Counts</strong>
<div id="viz"></div>
</body>
</html>
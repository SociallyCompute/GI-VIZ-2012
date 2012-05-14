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
	</script>
</head>
<body>
<div id="Header">INFO 655, Module 4.4.4</div>
<strong>Hashtag Counts</strong>
<div id="viz"></div>
</body>
</html>
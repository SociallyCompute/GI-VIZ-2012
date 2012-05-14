<!--
	Team 3 to Team 5:
	
	We really liked what you guys did with the change background button - and we 
	extended it for you. Check your file when you submitted because it had an 
	incorrect path to your d3 js file. I think you should also comment your code a bit 
	better so we know what is going on (don't worry, our team forgot to).
	
	* Made the "change background" button work... so if it is red, it goes blue and if 
	it is blue, it goes red.
	
	* Updated the path of your .js file to a web accessable one (yours wasn't correct
	anyway)... didn't include the css/ folder.
	
	* We added the date that each data point was taken... 
	
	* see the comments we did for this changes -
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <title>Team 5 - Module 4.4.4</title>
    <!-- UPDATED THE DIRECTORY to a WEB ACCESSABLE one -->
    <script type="text/javascript" src="http://mbostock.github.com/d3/d3.js""></script>
    <style type="text/css">

        #playground { background:#eee; text-align:center; padding-top:50px; }
        
        /* Took out the background in this class */
        .bar {
            display: inline-block;
            width: 30px;
            margin-right: 3px;
            color:white;
            border:4px outset #69c;
            border-bottom:1px solid #000;
            border-radius:4px 4px 0 0;
            vertical-align:bottom;
            font-family:sans-serif; font-size:10px
        }
        
        /* created 2 new classes that will be toggled */
        .defaultBackground { background: #369; }
        .changedBackground { background: red; }


    </style>
</head>
<body>

<div id="playground">


</div>

<script type='text/javascript'>

    d3.csv("catchingfire-hashtag-timeline.csv", function(csv) {
        var data = [];
        csv.forEach(function(row) {
            var d = {
                "bar" : parseInt(row.bar), //Match column definition/heading
                "title" : row.title,  //Match column definition/heading
                "date" : row.date  //Match column definition/heading
            };

            data.push(d);
            return data;

        });

        var transitionDurationMS = 200;
        var divs = d3.select("#playground").selectAll("div").data(data);

		// Initialized the defaultBackground class with the bars
        divs.enter().append("div")
            .attr("class", "bar defaultBackground")
            .text(
            function (data) {
            	// We added the date to appear under the data
                return data.bar + "\n\n" + data.date;
            }

        ).style("opacity", 0);
		
		divs.exit().transition().duration(transitionDurationMS)
            .style("opacity", 0)
            .remove();

        divs.transition().duration(transitionDurationMS)
            .style("opacity",1)
            .style("height", function(d){ return d.bar*.075+"px" }) //Adjusts height of bars to fit without scrolling
            .text(ƒ('toFixed'));

    });

    function display()
    {
    	// If the defaultBackground is active, add in the changed one and take the default
    	if(d3.select("#playground").selectAll("div").classed("defaultBackground")) {
    		d3.select("#playground").selectAll("div").classed("changedBackground",true);
    		d3.select("#playground").selectAll("div").classed("defaultBackground", false)
    	}else{
    		d3.select("#playground").selectAll("div").classed("changedBackground",false);
    		d3.select("#playground").selectAll("div").classed("defaultBackground", true)
    	}
    }


</script>

<input type="submit" name="mysubmit" value="Click to Change the Color" onclick="display()"  />

</body>
</html>

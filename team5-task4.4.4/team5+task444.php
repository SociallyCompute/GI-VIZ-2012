
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <title>Team 5 - Module 4.4.4</title>
    <script type="text/javascript" src="d3.v2.js?2.8.1"></script>
    <style type="text/css">

        #playground { background:#eee; text-align:center; padding-top:50px; }
        .bar {
            display: inline-block;
            width: 30px;
            margin-right: 3px;
            background: #369; color:white;
            border:4px outset #69c;
            border-bottom:1px solid #000;
            border-radius:4px 4px 0 0;
            vertical-align:bottom;
            font-family:sans-serif; font-size:10px
        }


    </style>
</head>
<body>

<div id="playground">


</div>

<script type='text/javascript'>

    d3.csv("catchingfire-hashtag-timeline1.csv", function(csv) {
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


        divs.enter().append("div")
            .attr("class", "bar")
            .text(
            function (data) {
                return data.bar;
            }

        )

            .style("opacity", 0);

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
        d3.select("#playground").selectAll("div").style("background","red");
    }


</script>

<input type="submit" name="mysubmit" value="Click to Change the Color" onclick="display()"  />

</body>
</html>

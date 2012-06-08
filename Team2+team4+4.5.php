<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <title>Team 4 - Module 4.4.4</title>
    <script type="text/javascript" src="css/d3.v2.js?2.8.1"></script>
    <style type="text/css">

        @import url("css/style.css?1.10.0");
        @import url("css/syntax.css?1.6.0");

        #playground { background:#eee; text-align:center; padding-top:50px; }
        .bar {
            display: inline-block;
            width: 30px;
            margin-right: 3px;
            /*background: #47997c; */
            color:black;
            border:4px outset #7c9981;
            border-bottom:1px solid #000;
            border-radius:4px 4px 0 0;
            vertical-align:bottom;
            font-family:sans-serif; font-size:10px
        }

        h2 {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            color:black;
            font-family:sans-serif; font-size:10px
        }

    </style>

</head>
<body>

<div id="playground">

</div>
<!-I added this script from http://www.verisi.com/resources/d3-tutorial-basic-charts.htm#s5 (view source)-!>
<!-the code is from section, "Static, "Stacked Bar Chart (with Title & Legend)"-!>


<script type='text/javascript'>
var vis = d3.select("#playground")
.append("svg:svg")
.attr("class", "chart")
.attr("width", 20)
.attr("height", 20);

vis.append("svg:rect")
.attr("fill", colors[2] )
.attr("x", labelpad / 2)
.attr("y", 140    )
.attr("width", 20)
.attr("height", 20);

vis.append("svg:text")
.attr("x", 30 + labelpad / 2)
.attr("y", 155    )
.text("iPod");

vis.append("svg:rect")
.attr("fill", colors[0] )
.attr("x", labelpad / 2)
.attr("y", 110    )
.attr("width", 20)
.attr("height", 20);

vis.append("svg:text")
.attr("x", 30 + labelpad / 2)
.attr("y", 125    )
.text("iPhone");

vis.append("svg:rect")
.attr("fill", colors[1] )
.attr("x", labelpad / 2)
.attr("y", 80    )
.attr("width", 20)
.attr("height", 20);

vis.append("svg:text")
.attr("x", 30 + labelpad / 2)
.attr("y", 95    )
.text("iPad");
</script>

<script type='text/javascript'>

        d3.csv("catchingfire-hashtag-timeline.csv", function(csv) {
            var data = [];
            csv.forEach(function(x) {
                var d = {
                    "bar" : parseInt(x.bar),
                    "title" : x.title,
                    "date" : x.date
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

        });





    </script>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Module 4.3</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
</head>

<body>

<fieldset>
    <legend>Please Enter Your Name</legend>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <label>First Name:</label><input type="text" name="fname"/><br/>
        <label>Last Name:</label><input type="text" name="lname"/><br/>
        <input type="submit" value="Submit"/>
    </form>
</fieldset>

<br/>&nbsp;<br/>

<h2 align="center">

    <?php

    if (isset($_GET['fname'])) {
        $fname = $_GET['fname'];
        $lname = $_GET['lname'];
        $name = $fname . " " . $lname;

        $openings = Array("Hello",
            "Hi",
            "Greetings",
            "Salutations");

        $dayTypes = Array(" happy",
            " great",
            " spectacular",
            "n awesome",
            " delicious",
            " random",
            "n arbitrary");

        $dayName['Mon'] = "Monday";
        $dayName['Tues'] = "Tuesday";
        $dayName['Wed'] = "Wednesday";
        $dayName['Thurs'] = "Thursday";
        $dayName['Fri'] = "Friday";
        $dayName['Sat'] = "Saturday";
        $dayName['Sun'] = "Sunday";

        function formGreeting($name, $openings)
        {
            return $openings[array_rand($openings)] . " " . $name . ", ";
        }

        function formDayType($dayTypes)
        {
            return " have a" . $dayTypes[array_rand($dayTypes)];
        }

        $d = date("D");

        echo formGreeting($name, $openings) . formDayType($dayTypes) . " " . $dayName[$d] . "!";
    }
    ?>

</h2>

<br/>&nbsp;<br/>

</body>
</html>
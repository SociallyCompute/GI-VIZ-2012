<?php
/**
 * File Name: index.php
 * Drexel University
 * INFO 655 Intro to Web Programming
 * Team 3
 * User: Tom Grigas
 * User: Yeo Kadodjomo
 * User: Anthony Tang
 * User: Benjamin Toll
 * Date: 5/3/12
 * Time: 8:55 PM
 *
 * This script will accept a string from a user and convert it into Morse code. Characters such as # and * are ignored.
 */

// Load up the array with the morse code equivalents

$morseCodeArray['A'] = ".- ";

$morseCodeArray['B'] = "-... ";

$morseCodeArray['C'] = "-.-. ";

$morseCodeArray['D'] = "-.. ";

$morseCodeArray['E'] = ". ";

$morseCodeArray['F'] = "..-. ";

$morseCodeArray['G'] = "--. ";

$morseCodeArray['H'] = ".... ";

$morseCodeArray['I'] = ".. ";

$morseCodeArray['J'] = ".--- ";

$morseCodeArray['K'] = "-.- ";

$morseCodeArray['L'] = ".-.. ";

$morseCodeArray['M'] = "-- ";

$morseCodeArray['N'] = "-. ";

$morseCodeArray['O'] = "--- ";

$morseCodeArray['P'] = ".--. ";

$morseCodeArray['Q'] = "--.- ";

$morseCodeArray['R'] = ".-. ";

$morseCodeArray['S'] = "... ";

$morseCodeArray['T'] = "- ";

$morseCodeArray['U'] = "..- ";

$morseCodeArray['V'] = "...- ";

$morseCodeArray['W'] = ".-- ";

$morseCodeArray['X'] = "-..- ";

$morseCodeArray['Y'] = "-.-- ";

$morseCodeArray['Z'] = "--.. ";

$morseCodeArray[1] = ".---- ";

$morseCodeArray[2] = "..--- ";

$morseCodeArray[3] = "...-- ";

$morseCodeArray[4] = "....- ";

$morseCodeArray[5] = "..... ";

$morseCodeArray[6] = "-.... ";

$morseCodeArray[7] = "--... ";

$morseCodeArray[8] = "---.. ";

$morseCodeArray[9] = "----. ";

$morseCodeArray[0] = "----- ";

// If the user did not click submit, do not run the PHP below

if (isset($_POST['stringToConvert']) && $_POST['stringToConvert'] != "") {

    $stringToConvert = $_POST['stringToConvert'];

}

?>

<html>
<head>
    <style type="text/css">

        body {
            text-align: center;
            height: 100%;
            font-size: 62.5%;
            font-family: Helvetica, arial, sans-serif;
            color: #000;
            background: #eceae1 url(/images/bg_body.png) repeat-x 0 0;
            margin: 0;
            padding: 0;
        }

        a {
            color: #007CA5;
            text-decoration: none;
            outline: none;
        }

        a:visited {
            color: #666;
        }

        a:active {
            color: #999;
        }

        img {
            border: 0px;
        }

        h1, .h1 {
            font-size: 2.4em;
        }

        h2, .h2 {
            font-size: 2em;
        }

            /* article headline 20pt */
        h3, .h3 {
            font-size: 1.8em;
        }

            /*  should be 18pt */
    </style>

    <title>Morse Code Conversion</title>
</head>

<body>
<div id="header"
"><h1>Drexel University</h1></div>
<div id="header"
"><h1>Info655 - Intro to Web Programming</h1></div>
<div id="header"
"><h2>Team Three: Tom Grigas, Yeo Kadodjomo, Anthony Tang, Benjamin Toll</h2></div>
<div id="example">Module 4.3 PHP</div>
<div id="content">
    <h1>Welcome!</h1>

    <p>Hello there. This program converts the text to Morse Code.</p>

    <p>Please enter in any text below:</p>

    <form action="" method="POST">
        <p>
            <i>Enter your text:</i> <input type="text" name="stringToConvert" size="20"/>
        </p>

        <p><input type="submit" value="Convert String to Morse Code"/></p>
    </form>
    <br>-------------------------------------------------------------------- </br>
</div>

<div id="footer"></div>
</body>
</html>

<h1>Your Results!</h1>
<?php

echo "<strong>Your String:</strong> " . $stringToConvert . "<br />";

// Make everything capital http://php.net/manual/en/function.strtoupper.php

$stringToConvert = strtoupper($stringToConvert);

$morseCodeString = "";


// How many characters are in a string? http://php.net/manual/en/function.strlen.php
for ($i = 0; $i < strlen($stringToConvert); $i++) {

    if ($stringToConvert[$i] == " ") {

        $morseCodeString .= "" . ""; // $morseCodeString = $morseCodeString." ";

    } else {

        $morseCodeString .= $morseCodeArray[$stringToConvert[$i]];

        // $stringToConvert[$i] will show C if a string is "CAT” and $i = 0;\

        // $morseCodeArray["C”] will show us -.-.

    }

}

echo "<strong>Your String in Morse Code:</strong> " . $morseCodeString . "<br />";

?>

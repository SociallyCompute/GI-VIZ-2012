<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mcarey
 * Date: 5/5/12
 * Time: 8:59 PM
 * To change this template use File | Settings | File Templates.
 */
//
$textcolor = 'black'; // default to black and 16px
$textsize = '16px';

if (isset($_POST['rdcolor'])) {

    $radiovalue = $_POST['rdcolor'];
    $textcolor = $radiovalue[0];


}

if (isset($_POST['rdsize'])) {

    $radiovalue1 = $_POST['rdsize'];
    $textsize = $radiovalue1[0];

}
$min_int = 0;
$max_int = 100;

$a = rand($min_int, $max_int);
$b = rand($min_int, $max_int);

$sum = $a + $b;

$output = $a . ' + ' . $b . ' = ' . $sum;



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Changing Text Color</title>


</head>
<body>

<form name="form1" method="POST">

    <div id="sometext">
        <h1>The ROYGBIV/Size Redux</h1>

        <h2 style="color:<?php echo $textcolor;?>; font-size:<?php echo $textsize;?>">The random number generated
            is: <?php echo $output?>
            **Choose any combination of color and size below to change this text**</h2>
    </div>

    <br><br>

    <table>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="red"></td>
            <td style="color:red">Red</td>
            <td><input type="radio" name="rdsize[]" value="12px"></td>
            <td style="font-size:12px">10px</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="orange"></td>
            <td style="color:orange">Orange</td>
            <td><input type="radio" name="rdsize[]" value="18px"></td>
            <td style="font-size:18px">16px</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="yellow"></td>
            <td style="color:yellow">Yellow</td>
            <td><input type="radio" name="rdsize[]" value="22px"></td>
            <td style="font-size:22px">22px</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="green"></td>
            <td style="color:green">Green</td>
            <td><input type="radio" name="rdsize[]" value="26px"></td>
            <td style="font-size:26px">26px</td>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="blue"></td>
            <td style="color:blue">Blue</td>
            <td><input type="radio" name="rdsize[]" value="32px"></td>
            <td style="font-size:35px">32px</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="indigo"></td>
            <td style="color:indigo">Indigo</td>
            <td><input type="radio" name="rdsize[]" value="40px"></td>
            <td style="font-size:42px">40px</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="violet"></td>
            <td style="color:violet">Violet</td>
            <td><input type="radio" name="rdsize[]" value="50px"></td>
            <td style="font-size:50px">50px</td>
        </tr>
    </table>

    <input type="submit" value="Submit"/>


</form>


</body>
</html>
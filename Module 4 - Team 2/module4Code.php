<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mcarey
 * Date: 5/5/12
 * Time: 8:59 PM
 * To change this template use File | Settings | File Templates.
 */

$textcolor = "black"; // default to black

if (isset($_POST['rdcolor'])) {

    $radiovalue = $_POST['rdcolor'];
    $textcolor = $radiovalue[0];


}

if (isset($_POST['rdsize'])) {

    $radiovalue1 = $_POST['rdsize'];
    $textsize = $radiovalue1[0];

}


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
        <h1>The ROYGBIV Redux</h1>

        <h2 style="color:<?php echo $textcolor;?>; font-size:<?php echo $textsize;?>">Choose a color and size below to
            change the appearance of this text.</h2>
    </div>

    <br><br>

    <table>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="red" onselect="sendform();"></td>
            <td style="color:red">Red</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="orange" onselect="sendform()";></td>
            <td style="color:orange">Orange</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="yellow" onselect="sendform();"></td>
            <td style="color:yellow">Yellow</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="green" onselect="sendform();"></td>
            <td style="color:green">Green</td>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="blue" onselect="sendform();"></td>
            <td style="color:blue">Blue</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="indigo" onselect="sendform();"></td>
            <td style="color:indigo">Indigo</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdcolor[]" value="violet" onselect="sendform();"></td>
            <td style="color:violet">Violet</td>

    </table>

    <table>
        <tr>
            <td><input type="radio" name="rdsize[]" value="12px" onselect="sendform();"></td>
            <td style="font-size:12px">10px</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdsize[]" value="18px" onselect="sendform();"></td>
            <td style="font-size:18px">16px</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdsize[]" value="22px" onselect="sendform();"></td>
            <td style="font-size:22px">22px</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdsize[]" value="26px" onselect="sendform();"></td>
            <td style="font-size:26px">26px</td>
        <tr>
            <td><input type="radio" name="rdsize[]" value="32px" onselect="sendform();"></td>
            <td style="font-size:35px">32px</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdsize[]" value="40px" onselect="sendform();"></td>
            <td style="font-size:42px">40px</td>
        </tr>
        <tr>
            <td><input type="radio" name="rdsize[]" value="50px" onselect="sendform();"></td>
            <td style="font-size:50px">50px</td>

    </table>

    <input type="submit" value="Submit"/>


</form>


</body>
</html>
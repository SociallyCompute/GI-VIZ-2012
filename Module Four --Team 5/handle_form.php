<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Some Feedback.....</title>
</head>
<body>
<table border="0" width="350px" bgcolor="#F0F0F0 " align="center">
    <tr>
        <td>
            <?php //this file receives data from the "Form_Practice.html
            ini_set('display_errors', 1);
            $title = $_POST['title'];
            $name = $_POST['lastname'];
            $email = $_POST['email'];
            $commnents = $_POST['comments'];
//print the date
            echo "TODAY IS " . date("m.d.y");
            echo "<br/>";
            echo "<br/>";
            echo "<br/>";
            echo "<br/>";
//print the data(name and title) received
            echo "Thank you , $title $name, for your comments!";
            echo "<br/>";
            $d = date("D");
            if (($d == "Fri") || ($d == "Sat") || ($d == "Sun"))
                echo "Have a great weekend!";
            else
                echo "Have a nice day!";
            ?>
        </td>
    </tr>
</table>
</body>
</html>
<!DOCTYPE HTML>
<html>
<head>
    <title>Text Change Example</title>
</head>
<body>
<script type="text/javascript" language="javascript">
    function validateForm(form) {
        with (form) {
            if (txtTitle.value == "") {
                alert("Please enter a page title");
                txtTitle.focus()
                return false;
            }
            return true;
        }
    }
</script>
<h1>
    <?php
    if (isset($_GET['txtTitle'])) {
        echo $_GET['txtTitle'];
    }
    else
    {
        echo "Default Page Title";
    }
    ?>
</h1>

<form action="index.php" method="get" onsubmit="return validateForm(this)">
    <label for="title">Enter a new page title</label><br/>
    <input type="text" name="txtTitle"/>
    <input type="submit"/>
</form>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Info</title>
    <style>
        body {
            margin: 20px;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
            Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
            font-size: 16px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<?php

if (isset($_POST['code']) && $_POST['code'] == "Ar122#")
{
    if (!isset($_POST['gender']) || $_POST['gender'] == 'male')
    {
        echo "<p> Thanks Mr ";
    }
    else if ($_POST['gender'] == 'female')
    {
        echo "<p> Thanks Miss";
    }

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    if (isset($fname))
    {
        echo $fname . " ";
    }
    else
    {
        $fname = "unknown";
    }

    if (isset($lname))
    {
        echo $lname;
    }
    else
    {
        $lname = "unknown";
    }

    echo "</p>";

    echo "<br><p>Please Review Your Information</p><br>";

    echo "Name: $fname $lname<br><br>";


    echo "Address:<br>";
    if (isset($_POST['address']))
    {
        echo $_POST['address'];
    }

    echo "<br><br>Your Skills<br>";
    if (isset($_POST['skills']))
    {
        echo "<ul>";
        foreach ($_POST['skills'] as $skill)
        {
            echo "<li>$skill</li>";
        }
        echo "</ul>";
    }
    echo '<br>';

    echo "Department: {$_POST["department"]}<br>";

}
else
{
    echo "<script> alert(\"InvalidCode\") </script>";
    header("Location: index.php");
    die("invalid code");
}
?>
</body>
</html>


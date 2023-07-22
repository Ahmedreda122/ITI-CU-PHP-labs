<?php
//
//if (isset($_POST['code']) && $_POST['code'] == "Ar122#")
//{
//    if (!isset($_POST['gender']) || $_POST['gender'] == 'male')
//    {
//        echo "<p> Thanks Mr ";
//    }
//    else if ($_POST['gender'] == 'female')
//    {
//        echo "<p> Thanks Miss";
//    }
//
//    $fname = $_POST['fname'];
//    $lname = $_POST['lname'];
//    if (isset($fname))
//    {
//        echo $fname . " ";
//    }
//    else
//    {
//        $fname = "unknown";
//    }
//
//    if (isset($lname))
//    {
//        echo $lname;
//    }
//    else
//    {
//        $lname = "unknown";
//    }
//
//    echo "</p><br>";
//
//    echo "<br><p>Please Review Your Information</p><br>";
//
//    echo "Name: $fname $lname<br>";
//
//    echo "Address:";
//    if (isset($_POST['address']))
//    {
//        echo $_POST['address'];
//    }
//
//    echo "Your Skills<br>";
//    if (isset($_POST['skills']))
//    {
//        echo "<ul>";
//        foreach ($_POST['skills'] as $skill)
//        {
//            echo "<li>$skill</li>";
//        }
//        echo "</ul>";
//    }
//    echo '<br>';
//
//    echo "Department: {$_POST["department"]}<br>";
//
//}
//else
//{
//    header("Location: index.php");
//}
    $errors = array();

    if ( !isset($_POST["fname"]) || empty($_POST["fname"]))
    {
        $errors['fname'] = true;
    }

    if (!isset($_POST["gender"]))
    {
        $errors['gender'] = true;
    }

    if (!isset($_POST["lname"]) || empty($_POST["lname"]))
    {
        $errors['lname'] = true;
    }

    $old_values = array();

    if (!empty($errors))
    {
        $formErrors = json_encode($errors);
        $old_values =  json_encode($_POST);

       header("Location: index.php?errors={$formErrors}&oldValues=$old_values");
       die();
    }

try
{
    $file = fopen("table.csv", "a");
    foreach ($_POST as $key => $value)
    {
        if ($key === 'pass' || $key === 'code' || $key === 'edit')
        {
            continue;
        }

        if ($key === "skills")
        {
            foreach ($value as $skill)
            {
                fwrite($file, "$skill | ");
            }
            $stat = fstat($file);
            ftruncate($file, $stat['size']-2);
            fwrite($file, ",");
        }
        else
        {
            fwrite($file, "$value,");
        }
    }

    $stat = fstat($file);
    ftruncate($file, $stat['size']-1);
    fwrite($file, "\n");
    fclose($file);

} catch (Exception $e)
{
    echo $e->getMessage();
}

if (isset($_POST['edit']) && $_POST['edit'] == true)
{
    header("Location: delete.php?username={$_POST['username']}");
    die();
}
header("Location: index.php");
die();

<?php
$errors = array();

if (!isset($_POST["usrname"]) || empty($_POST["usrname"]))
{
    $errors['usrname'] = true;
}


if (isset($_POST["email"]))
{
    $pattern= "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";

    $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL, ["flags" => FILTER_NULL_ON_FAILURE]);

    if ($email === null || !preg_match($pattern,$_POST["email"]))
    {
        $errors['email'] = true;
    }
}
else
{
    $errors['email'] = true;
}

if (isset($_POST["password"]))
{
    $pattern= '/^[a-z0-9_]{8}$/';

    if(!preg_match($pattern,$_POST["password"]))
    {
        $errors['password'] = true;
    }
}
else
{
    $errors['password'] = true;
}

$path = "";
if (isset($_FILES['img']) && !empty($_FILES['img']['name']))
{
    $imgName = $_FILES['img']['name'];
    $imgTmpName = $_FILES['img']['tmp_name'];


    $extension = pathinfo($imgName)['extension'];
    if (in_array($extension, array('jpg', 'jpeg', 'png', 'gif', 'svg')))
    {
        $imgNewName = trim(time());
        $path = "images/{$imgNewName}.{$extension}";
        move_uploaded_file($imgTmpName, $path);
    }
    else
    {
        $errors['img'] = "unsupported extension";
    }
}
else
{
    $errors['img'] = "Image not found";
}

$old_values = array();

if (!empty($errors))
{
    $formErrors = json_encode($errors);
    $old_values =  json_encode($_POST);
    if (isset($_GET['edit'])) {
        header("Location: edit.php?errors={$formErrors}&oldData=$old_values&ID={$_GET['ID']}");
        die();
    }
    header("Location: AddUser.php?errors={$formErrors}&oldValues=$old_values");
    die();
}



try
{
    require_once 'DB.php';
    $db = new DB();
    $pdo = $db->connect('root', null);

    $colValues = $_POST;
    $colValues['path'] = $path;

    if (isset($_GET['edit'])) {
        $db->updateFive($pdo, $_GET['ID'], 'users', $colValues);
    }
    else
    {
        $colNames =
          ['Name', 'Password', 'Email', 'Room','img'];
        $db->insertFive($pdo,'users', $colNames, $colValues);
    }
    unset($pdo);

} catch (Exception $e)
{
    echo $e->getMessage();
}

header("Location: welcome.php");
die();
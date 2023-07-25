<?php
$ID = $_GET['ID'];
try
{
    require_once 'DB.php';
    $db = new DB();
    $pdo = $db->connect('root', null);
    $db->delete($pdo, $ID, "users");
    unset($pdo);

} catch (Exception $e)
{
    echo $e->getMessage();
}

header("Location: welcome.php");
die();
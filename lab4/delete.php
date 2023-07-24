<?php
$ID = $_GET['ID'];
try
{
    require_once 'connect.php';
    $preparedsql = "DELETE FROM users WHERE ID = ?";
    $stmt = $pdo->prepare($preparedsql);
    $stmt->bindParam(1, $ID , PDO::PARAM_INT);
    $stmt->execute();
    unset($pdo);

} catch (Exception $e)
{
    echo $e->getMessage();
}

header("Location: welcome.php");
die();
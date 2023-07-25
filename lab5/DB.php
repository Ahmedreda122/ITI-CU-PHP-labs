<?php
class DB{
    function connect($username, $password, $dsn = "mysql:dbname=data;host=localhost;port=3306"): false|PDO
    {
        try {
            $pdo = new PDO($dsn, $username, $password);
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
        return $pdo;
    }

    function insertFive(PDO $pdo,string $tableName,array $colNames, array $colValues)
    {
        try {
            $preparedSQL = "INSERT INTO $tableName ($colNames[0], $colNames[1], $colNames[2], $colNames[3], $colNames[4]) 
        VALUES (:name,:pass,:email,:room,:img)";

            $stmt = $pdo->prepare($preparedSQL);
            $stmt->bindParam(':name', $colValues['usrname']);
            $stmt->bindParam(':pass', $colValues['password']);
            $stmt->bindParam(':email', $colValues['email']);
            $stmt->bindParam(':room', $colValues['room']);
            $stmt->bindParam(':img', $colValues['path']);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function updateFive(PDO $pdo,$ID,string $tableName, array $colValues)
    {
        try {
            $preparedSQL = "UPDATE $tableName SET Name = :name, Password = :pass, Email = :email, Room = :room, img = :img WHERE ID = :ID";;
            $stmt = $pdo->prepare($preparedSQL);
            $stmt->bindParam(':ID', $ID);
            $stmt->bindParam(':name', $colValues['usrname']);
            $stmt->bindParam(':pass', $colValues['password']);
            $stmt->bindParam(':email', $colValues['email']);
            $stmt->bindParam(':room', $colValues['room']);
            $stmt->bindParam(':img', $colValues['path']);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function delete(PDO $pdo,$ID,string $tableName)
    {
        try {
            $preparedsql = "DELETE FROM $tableName WHERE ID = :ID";
            $stmt = $pdo->prepare($preparedsql);
            $stmt->bindParam(':ID', $ID , PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function selectFive(PDO $pdo, $tableName, array $colNames): false|array
    {
        try {
            $query = "SELECT $colNames[0], $colNames[1], $colNames[2], $colNames[3], $colNames[4], $colNames[5] FROM $tableName;";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $e) {
            echo $e->getMessage();
        }
        return $data;
    }
}


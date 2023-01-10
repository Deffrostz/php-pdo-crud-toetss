<?php

require('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        echo 'Connected to $dbName at $dbHost successfully.';
    } else {
        echo 'Connection failed.';
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

$sql = "DELETE FROM DureAuto WHERE Id = :Id";

$statement = $pdo->prepare($sql);

$statement->bindValue(':Id', $_GET['Id'], PDO::PARAM_INT);

$result = $statement->execute();

if ($result) {
    echo 'Record is verwijderd.';
    header('Refresh: 2.5; URL=read.php');
} else {
    echo 'Record is niet verwijderd.';
}
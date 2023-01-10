<?php
include ('config.php');

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

$sql = "SELECT Merk ,Model ,Topsnelheid ,Prijs FROM DureAuto";

$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_OBJ);


$tableRows = "";

foreach ($result as $info) {
    $tableRows .=   "<tr>
                        <td>$info->Merk</td>
                        <td>$info->Model</td>
                        <td>$info->Topsnelheid</td>
                        <td>$info->Prijs</td>
                        <td>
                            <a href='delete.php?Id=$info->ID'>
                                <img src='img/b_drop.png' alt='cross'>
                            </a>
                        </td>
                        </tr>";
}

?>

<h3>Persoonsgegevens</h3>

<table border="1">
    <thead>
        <th>Merk</th>
        <th>Model</th>
        <th>Topsnelheid</th>
        <th>Prijs</th>
        <th>Delete</th>
    </thead>
    <tbody>
        <?php echo $tableRows; ?>
    </tbody>
</table>
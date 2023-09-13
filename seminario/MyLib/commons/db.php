<?php

$pass = "root";
$usr = "postgres";
$dbn = "mylib";
$host = "localhost";
$port = "5432"; //5432

try {
    $db = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbn",
        $usr,
        $pass
    );

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    echo "Exception in DB: " . $e->getMessage();
}
?>
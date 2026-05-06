<?php
$host = "localhost";
$db   = "perpustakaan_db";
$user = "root";
$pass = "";

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
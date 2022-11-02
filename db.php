<?php

$host = 'localhost';
$user = 'root';
$password = 'root';
$db = 'users';

try {
    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db, $user, $password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
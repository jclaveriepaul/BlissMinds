<?php
$host = 'localhost';
$db   = 'CSY2088';
$user = 'jclaveriepaul';
$pass = 'jclaver1epaul';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $opt);

    $stmt = $pdo->query('SELECT date FROM BlissMinds');
    $bookedDates = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    // Convert datetime to date
    $bookedDates = array_map(function($date) {
        return date('Y-m-d', strtotime($date));
    }, $bookedDates);
} catch (Exception $e) {
    // If an error occurs, return an empty array
    $bookedDates = [];
}

echo json_encode($bookedDates);
?>
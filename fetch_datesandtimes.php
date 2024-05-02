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

    $stmt = $pdo->query('SELECT date, appointmenttime FROM BlissMinds');
    $bookedAppointments = $stmt->fetchAll();

    $bookedDatesAndTimes = [];
    foreach ($bookedAppointments as $appointment) {
        $date = date('d-m-Y', strtotime($appointment['date']));
        $time = date('H:i', strtotime($appointment['appointmenttime']));
        $bookedDatesAndTimes[$date][] = $time;
    }
} catch (Exception $e) {
    // If an error occurs, return an empty array
    $bookedDatesAndTimes = [];
}

echo json_encode($bookedDatesAndTimes);
?>
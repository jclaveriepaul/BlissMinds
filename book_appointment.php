<?php



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'mysql-200-128.mysql.fasthosts.co.uk';
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
$pdo = new PDO($dsn, $user, $pass, $opt);

$clientname = $_POST['clientname'];
$clientemail = $_POST['clientemail'];
$clientphonenumber = $_POST['clientphonenumber'];
$clientrequests = $_POST['clientrequests'];
$date = $_POST['date'];

// Determine the appointment type based on the referer

if (isset($_GET['appointmenttype'])) {
    $appointmenttype = $_GET['appointmenttype'];
} else {
    $appointmenttype = 'Unknown';
}

$sql = "INSERT INTO BlissMinds (clientname, clientemail, clientphonenumber, clientrequests, date, appointmenttype) VALUES (?, ?, ?, ?, ?, ?)";
$stmt= $pdo->prepare($sql);
$stmt->execute([$clientname, $clientemail, $clientphonenumber, $clientrequests, $date, $appointmenttype]);

// Send an email to the user with the details of their appointment
$to = $clientemail;
$subject = "Your Appointment Details";
$message = "
    Hi $clientname,

    Here are the details of your appointment:

    Date: $date
    Phone: $clientphonenumber
    Requests: $clientrequests
    Appointment Type: $appointmenttype
";

$headers = "From: noreply@yourwebsite.com";

mail($to, $subject, $message, $headers);

exit;
?>
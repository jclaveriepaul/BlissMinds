<?php
session_start();
if (isset($_SESSION['appointmenttype'])) {
    $appointmenttype = $_SESSION['appointmenttype'];
} else {
    $appointmenttype = 'Unknown';
}

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

$clientname = $_POST['clientname'] ?? 'Unknown';
$clientemail = $_POST['clientemail'] ?? 'Unknown';
$clientphonenumber = !empty($_POST['clientphonenumber']) ? $_POST['clientphonenumber'] : 'N/A';
$clientrequests = $_POST['clientrequests'] ?? 'Unknown';
$date = $_POST['date'] ?? 'Unknown';
if ($date !== 'Unknown') {
    $date = DateTime::createFromFormat('mm/dd/yyyy', $date)->format('Y-m-d');
}
$appointmenttype = $_POST['appointmenttype'] ?? 'Unknown';
$appointmenttime = $_POST['appointmenttime'] ?? 'Unknown';

$sql = "INSERT INTO BlissMinds (clientname, clientemail, clientphonenumber, clientrequests, date, appointmenttype, appointmenttime) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt= $pdo->prepare($sql);
$stmt->execute([$clientname, $clientemail, $clientphonenumber, $clientrequests, $date, $appointmenttype, $appointmenttime]);

// Send an email to the user with the details of their appointment
$to = $clientemail;
$subject = "Your Appointment Details";
$message = "
    Hi $clientname,

    Here are the details of your appointment:

    Date: $date
    Time: $appointmenttime
    Phone: $clientphonenumber
    Requests: $clientrequests
    Appointment Type: $appointmenttype
";

$headers = "From: noreply@yourwebsite.com";

mail($to, $subject, $message, $headers);

echo "<div style='background-color: #f0f0f0; padding: 10px; margin: 10px 0; border-radius: 5px;'>
    Hi $clientname, Thank you for booking a $appointmenttype appointment with us here at BlissMinds. We look forward to seeing you at $appointmenttime on $date.
</div>";

exit;
?>
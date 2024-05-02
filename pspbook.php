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
$pdo = new PDO($dsn, $user, $pass, $opt);

$stmt = $pdo->query('SELECT date FROM BlissMinds');
$bookedDates = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

// Convert datetime to date
$bookedDates = array_map(function($date) {
    return date('Y-m-d', strtotime($date));
}, $bookedDates);

echo json_encode($bookedDates);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $.getJSON('getBookedDates.php', function(bookedDates) {
            $( "#datepicker" ).datepicker({
                beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    return [ bookedDates.indexOf(string) == -1 ]
                },
                minDate: 0
            });
        });
    } );
    </script>
</head>
<body>
    <div id="datepicker"></div>
</body>
</html>
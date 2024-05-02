<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['service'] = $_POST['service'];
    $_SESSION['appointmenttype'] = $_POST['appointmenttype'];
}
?>
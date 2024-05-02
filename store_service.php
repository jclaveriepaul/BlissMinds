<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['service'])) {
    $_SESSION['service'] = $_POST['service'];
}
?>
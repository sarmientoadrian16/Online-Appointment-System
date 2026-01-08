<?php
include 'db.php';

$appointment_id = intval($_POST['appointment_id']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$service = intval($_POST['service']);
$date = $_POST['date'];
$time = $_POST['time'];

// Update user info
// First, get user_id from appointment
$res = mysqli_query($conn, "SELECT user_id FROM appointments WHERE appointment_id=$appointment_id");
$user = mysqli_fetch_assoc($res);
$user_id = $user['user_id'];

// Update user table
mysqli_query($conn, "UPDATE users SET full_name='$name', email='$email' WHERE user_id=$user_id");

// Update appointment table
mysqli_query($conn, "UPDATE appointments SET service_id=$service, appointment_date='$date', appointment_time='$time' WHERE appointment_id=$appointment_id");

header("Location: index.php");
exit;
?>

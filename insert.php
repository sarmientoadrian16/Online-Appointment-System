<?php
include 'db.php';


$name = $_POST['name'];
$email = $_POST['email'];
$service = $_POST['service'];
$date = $_POST['date'];
$time = $_POST['time'];


mysqli_query($conn, "INSERT INTO users (full_name, email) VALUES ('$name','$email')");
$user_id = mysqli_insert_id($conn);


mysqli_query($conn, "INSERT INTO appointments (user_id, service_id, appointment_date, appointment_time)
VALUES ($user_id, $service, '$date', '$time')");


header("Location: index.php");
?>
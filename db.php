<?php
$conn = mysqli_connect("localhost", "root", "", "appointment_system");
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
?>
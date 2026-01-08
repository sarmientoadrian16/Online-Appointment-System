<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Appointment System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Appointment</h2>
<form action="insert.php" method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <select name="service" required>
        <option value="">Select Service</option>
        <?php
        $services = mysqli_query($conn, "SELECT * FROM services");
        while ($row = mysqli_fetch_assoc($services)) {
            echo "<option value='{$row['service_id']}'>{$row['service_name']}</option>";
        }
        ?>
    </select>
    <input type="date" name="date" required>
    <input type="time" name="time" required>
    <button type="submit">Submit</button>
</form>

<h2>Appointments</h2>
<table>
<tr>
    <th>Name</th>
    <th>Service</th>
    <th>Date</th>
    <th>Time</th>
    <th>Action</th>
</tr>

<?php
$result = mysqli_query($conn, "
    SELECT a.appointment_id, a.appointment_date, a.appointment_time, u.full_name, s.service_name
    FROM appointments a
    JOIN users u ON a.user_id = u.user_id
    JOIN services s ON a.service_id = s.service_id
");

if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
        // Define variables for each row
        $id = $row['appointment_id'];
        $full_name = isset($row['full_name']) ? $row['full_name'] : 'No Name';
        $service_name = isset($row['service_name']) ? $row['service_name'] : 'No Service';
        $date = $row['appointment_date'];
        $time = $row['appointment_time'];

        echo "<tr>
            <td>$full_name</td>
            <td>$service_name</td>
            <td>$date</td>
            <td>$time</td>
            <td>
                <a href='update.php?id=$id'>Edit</a> | 
                <a href='delete.php?id=$id'>Delete</a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No appointments found.</td></tr>";
}
?>

</table>

</body>
</html>

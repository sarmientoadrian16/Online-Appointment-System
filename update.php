<?php
include 'db.php';

// Check if ID is passed
if(!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

// Fetch appointment data
$result = mysqli_query($conn, "
    SELECT a.appointment_id, a.appointment_date, a.appointment_time, u.full_name, u.email, s.service_id, s.service_name
    FROM appointments a
    JOIN users u ON a.user_id = u.user_id
    JOIN services s ON a.service_id = s.service_id
    WHERE a.appointment_id = $id
");

if(mysqli_num_rows($result) == 0) {
    echo "Appointment not found!";
    exit;
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Edit Appointment</h2>

<form action="update_action.php" method="POST">
    <input type="hidden" name="appointment_id" value="<?php echo $row['appointment_id']; ?>">
    <input type="text" name="name" value="<?php echo $row['full_name']; ?>" required>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
    
    <select name="service" required>
        <?php
        $services = mysqli_query($conn, "SELECT * FROM services");
        while($s = mysqli_fetch_assoc($services)) {
            $selected = ($s['service_id'] == $row['service_id']) ? 'selected' : '';
            echo "<option value='{$s['service_id']}' $selected>{$s['service_name']}</option>";
        }
        ?>
    </select>
    
    <input type="date" name="date" value="<?php echo $row['appointment_date']; ?>" required>
    <input type="time" name="time" value="<?php echo $row['appointment_time']; ?>" required>
    <button type="submit">Update</button>
</form>

<p><a href="index.php">Back to Appointments</a></p>

</body>
</html>

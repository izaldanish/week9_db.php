<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET matric = '$matric', name = '$name', role = '$role' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: display.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    header("Location: display.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>Matric:</label>
        <input type="text" name="matric" value="<?php echo $row['matric']; ?>" required><br><br>
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>
        <label>Role:</label>
        <select name="role" required>
            <option value="Student" <?php echo ($row['role'] == 'Student') ? 'selected' : ''; ?>>Student</option>
            <option value="Lecturer" <?php echo ($row['role'] == 'Lecturer') ? 'selected' : ''; ?>>Lecturer</option>
        </select><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>

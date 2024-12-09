<?php
include 'db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = $_POST['role'];

    // Insert data into the database
    $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="">
        <label>Matric:</label>
        <input type="text" name="matric" required><br><br>
        
        <label>Name:</label>
        <input type="text" name="name" required><br><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        
        <label>Role:</label>
        <select name="role" required>
            <option value="Student">Student</option>
            <option value="Lecturer">Lecturer</option>
        </select><br><br>
        
        <button type="submit">Register</button>
    </form>
</body>
</html>

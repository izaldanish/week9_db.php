<?php
include 'db.php';
session_start();

// Restrict access if not logged in
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Delete functionality
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_sql = "DELETE FROM users WHERE id = '$id'";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: display.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display Users</title>
</head>
<body>
    <h2>User List</h2>
    <table border="1">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['matric'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "<td>";
                echo "<a href='update.php?id=" . $row['id'] . "'>Edit</a> | ";
                echo "<a href='display.php?delete=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

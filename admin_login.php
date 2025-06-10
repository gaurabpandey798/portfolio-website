<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('db_connection.php');
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hash password (use more secure method like bcrypt in production)
    $hashed_password = md5($password);
    
    // Check credentials
    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$hashed_password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <form method="POST" action="admin_login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Login">
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    </form>
</body>
</html>

<?php
// Include database connection
include('db_connection.php');

// Start session and check if user is logged in (for security)
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// Fetch contact form responses from the database
$sql = "SELECT * FROM contact_form ORDER BY id DESC"; // Fetch responses in descending order
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Add some professional styling here -->
     <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="admin-container">
        <h1>Admin Dashboard</h1>
        <a href="admin_logout.php" class="logout">Logout</a>
        <h2>Contact Form Responses</h2>

        <!-- Table to display responses -->
        <table class="response-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                        echo "<td>" . nl2br(htmlspecialchars($row['message'])) . "</td>";
                        echo "<td>" . $row['date_sent'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No responses yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

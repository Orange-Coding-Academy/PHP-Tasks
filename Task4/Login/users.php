
<?php
require "db.php";

// Check login
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Get all users
$result = $conn->query(
    "SELECT id, name, email FROM users"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container users-container">
    <h2>Registered Users</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>

        <?php while ($user = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($user["id"]) ?></td>
                <td><?= htmlspecialchars($user["name"]) ?></td>
                <td><?= htmlspecialchars($user["email"]) ?></td>
            </tr>
        <?php } ?>
    </table>

    <p><a href="logout.php">Logout</a></p>
</div>

</body>
</html>

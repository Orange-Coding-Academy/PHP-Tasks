
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

require "db.php";

$stmt = $conn->query(
    "SELECT id, name, email, created_at
     FROM users
     ORDER BY id DESC"
);

$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="users-container">

    <h2>Welcome, <?= htmlspecialchars($_SESSION["user_name"]) ?></h2>

    <p>All Registered Users</p>

    <a class="logout" href="logout.php">Logout</a>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registration Date</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars((string)$user["id"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($user["name"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($user["email"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($user["created_at"]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="4">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>

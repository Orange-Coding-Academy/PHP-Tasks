
<?php
session_start();
require "db.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

$message = "";
$editUser = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    if ($action == "delete") {
        if ($_POST["id"] != $_SESSION["admin_id"]) {
            $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$_POST["id"]]);
        } else {
            $message = "You cannot delete your own account.";
        }
    }

    if ($action == "save") {
        $id = $_POST["id"] ?? "";
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = $_POST["password"] ?? "";

        if ($name == "" || $email == "" ||
            (!filter_var($email, FILTER_VALIDATE_EMAIL)) ||
            ($id == "" && $password == "")) {
            $message = "Please enter valid required fields.";
        } else {
            $stmt = $conn->prepare(
                "SELECT id FROM users WHERE email = ? AND id != ?"
            );
            $stmt->execute([$email, $id ?: 0]);

            if ($stmt->fetch()) {
                $message = "Email already exists.";
            } else {
                if ($id != "") {
                    if ($password != "") {
                        $hashed = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $conn->prepare(
                            "UPDATE users SET name=?, email=?, password=? WHERE id=?"
                        );
                        $stmt->execute([$name, $email, $hashed, $id]);
                    } else {
                        $stmt = $conn->prepare(
                            "UPDATE users SET name=?, email=? WHERE id=?"
                        );
                        $stmt->execute([$name, $email, $id]);
                    }
                } else {
                    $hashed = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare(
                        "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
                    );
                    $stmt->execute([$name, $email, $hashed]);
                }

                header("Location: users.php");
                exit;
            }
        }
    }
}

if (isset($_GET["edit"])) {
    $stmt = $conn->prepare(
        "SELECT id, name, email FROM users WHERE id = ?"
    );
    $stmt->execute([$_GET["edit"]]);
    $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
}

$users = $conn->query(
    "SELECT id, name, email FROM users"
)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="users.php">Users</a>
        <a href="products.php">Products</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h1>Manage Users</h1>
    <p class="error"><?= htmlspecialchars($message) ?></p>

    <h2><?= $editUser ? "Edit User" : "Add User" ?></h2>

    <form method="POST">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id"
               value="<?= $editUser["id"] ?? "" ?>">

        <input name="name" placeholder="Name" required
               value="<?= htmlspecialchars($editUser["name"] ?? "") ?>">

        <input type="email" name="email" placeholder="Email" required
               value="<?= htmlspecialchars($editUser["email"] ?? "") ?>">

        <input type="password" name="password"
               placeholder="<?= $editUser ? "New password (optional)" : "Password" ?>"
               <?= $editUser ? "" : "required" ?>>

        <button type="submit">Save User</button>
    </form>

    <h2>All Users</h2>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Actions</th>
        </tr>

        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user["id"] ?></td>
            <td><?= htmlspecialchars($user["name"]) ?></td>
            <td><?= htmlspecialchars($user["email"]) ?></td>
            <td>
                <a href="users.php?edit=<?= $user["id"] ?>">Edit</a>

                <form method="POST" class="inline-form"
                      onsubmit="return confirm('Delete this user?')">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id"
                           value="<?= $user["id"] ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>

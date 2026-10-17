
<?php
session_start();
require "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        session_regenerate_id(true);
        $_SESSION["admin_id"] = $user["id"];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>

        <p class="error">
            <?= htmlspecialchars($error) ?>
        </p>

        <form method="POST">
            <input type="email" name="email"
                   placeholder="Email" required>

            <input type="password" name="password"
                   placeholder="Password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

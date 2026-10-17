
<?php
require "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $message = "Email already exists!";
    } else {

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user
        $stmt = $conn->prepare(
            "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
        );

        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            $message = "Registration failed!";
        }

        $stmt->close();
    }

    $check->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Register</h2>

    <p class="message">
        <?= htmlspecialchars($message) ?>
    </p>

    <form method="POST">
        <input type="text" name="name"
               placeholder="Full Name" required>

        <input type="email" name="email"
               placeholder="Email" required>

        <input type="password" name="password"
               placeholder="Password" required>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account?
        <a href="login.php">Login</a>
    </p>
</div>

</body>
</html>

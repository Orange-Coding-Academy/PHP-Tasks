
<?php
require "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare(
        "SELECT id, password FROM users WHERE email = ?"
    );

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $stmt->store_result();
    $stmt->bind_result($id, $hashedPassword);

    if ($stmt->fetch() && password_verify($password, $hashedPassword)) {

        session_regenerate_id(true);
        $_SESSION["user_id"] = $id;

        header("Location: users.php");
        exit;

    } else {
        $message = "Invalid email or password!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <p class="message">
        <?= htmlspecialchars($message) ?>
    </p>

    <form method="POST">
        <input type="email" name="email"
               placeholder="Email" required>

        <input type="password" name="password"
               placeholder="Password" required>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account?
        <a href="register.php">Register</a>
    </p>
</div>

</body>
</html>

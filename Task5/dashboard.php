
<?php
session_start();
require "db.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

$usersCount = $conn->query(
    "SELECT COUNT(*) FROM users"
)->fetchColumn();

$productsCount = $conn->query(
    "SELECT COUNT(*) FROM products"
)->fetchColumn();

$users = $conn->query(
    "SELECT id, name, email FROM users"
)->fetchAll(PDO::FETCH_ASSOC);

$products = $conn->query(
    "SELECT * FROM products"
)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>

        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="users.php">Manage Users</a>
            <a href="products.php">Manage Products</a>
            <a href="logout.php">Logout</a>
        </nav>

        <div class="cards">
            <div class="card">
                <h3>Total Users</h3>
                <p><?= $usersCount ?></p>
            </div>

            <div class="card">
                <h3>Total Products</h3>
                <p><?= $productsCount ?></p>
            </div>
        </div>

        <h2>Users</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>

            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user["id"] ?></td>
                    <td><?= htmlspecialchars($user["name"]) ?></td>
                    <td><?= htmlspecialchars($user["email"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Products</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created Date</th>
            </tr>

            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product["id"] ?></td>
                    <td><?= htmlspecialchars($product["name"]) ?></td>
                    <td><?= htmlspecialchars($product["description"]) ?></td>
                    <td><?= $product["price"] ?></td>
                    <td><?= $product["quantity"] ?></td>
                    <td><?= $product["created_at"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>

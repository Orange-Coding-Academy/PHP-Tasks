
<?php
session_start();
require "db.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    if ($action == "delete") {
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$_POST["id"]]);
        header("Location: products.php");
        exit;
    }

    if ($action == "save") {
        $id = $_POST["id"] ?? "";
        $name = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];

        if ($name == "" || $description == "" ||
            !is_numeric($price) || $price < 0 ||
            filter_var($quantity, FILTER_VALIDATE_INT) === false ||
            $quantity < 0) {
            $message = "Please enter valid product information.";
        } else {
            if ($id != "") {
                $stmt = $conn->prepare(
                    "UPDATE products
                     SET name=?, description=?, price=?, quantity=?
                     WHERE id=?"
                );
                $stmt->execute([$name, $description, $price, $quantity, $id]);
            } else {
                $stmt = $conn->prepare(
                    "INSERT INTO products (name, description, price, quantity)
                     VALUES (?, ?, ?, ?)"
                );
                $stmt->execute([$name, $description, $price, $quantity]);
            }

            header("Location: products.php");
            exit;
        }
    }
}

$editProduct = null;

if (isset($_GET["edit"])) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$_GET["edit"]]);
    $editProduct = $stmt->fetch(PDO::FETCH_ASSOC);
}

$products = $conn->query(
    "SELECT * FROM products"
)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
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

    <h1>Manage Products</h1>
    <p class="error"><?= htmlspecialchars($message) ?></p>

    <h2><?= $editProduct ? "Edit Product" : "Add Product" ?></h2>

    <form method="POST">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id"
               value="<?= $editProduct["id"] ?? "" ?>">

        <input name="name" placeholder="Product Name" required
               value="<?= htmlspecialchars($editProduct["name"] ?? "") ?>">

        <textarea name="description" placeholder="Description"
                  required><?= htmlspecialchars($editProduct["description"] ?? "") ?></textarea>

        <input type="number" name="price" placeholder="Price"
               min="0" step="0.01" required
               value="<?= $editProduct["price"] ?? "" ?>">

        <input type="number" name="quantity" placeholder="Quantity"
               min="0" step="1" required
               value="<?= $editProduct["quantity"] ?? "" ?>">

        <button type="submit">Save Product</button>
    </form>

    <h2>All Products</h2>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Description</th>
            <th>Price</th><th>Quantity</th><th>Created Date</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product["id"] ?></td>
            <td><?= htmlspecialchars($product["name"]) ?></td>
            <td><?= htmlspecialchars($product["description"]) ?></td>
            <td><?= $product["price"] ?></td>
            <td><?= $product["quantity"] ?></td>
            <td><?= $product["created_at"] ?></td>
            <td>
                <a href="products.php?edit=<?= $product["id"] ?>">Edit</a>

                <form method="POST" class="inline-form"
                      onsubmit="return confirm('Delete this product?')">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id"
                           value="<?= $product["id"] ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>

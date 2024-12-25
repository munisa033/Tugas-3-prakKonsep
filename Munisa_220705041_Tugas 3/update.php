<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM menu WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        die("Item not found!");
    }
} else {
    die("Invalid ID!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "UPDATE menu SET name = :name, price = :price, description = :description WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':name' => $name,
            ':price' => $price,
            ':description' => $description,
            ':id' => $id,
        ]);
        header("Location: read.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu Item</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            color: #4a4a4a;
        }

        body {
            display: flex;
            flex-direction: column;
            background: linear-gradient(
                rgba(255, 233, 204, 0.9),
                rgba(255, 232, 206, 0.9)
            ), url('background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            justify-content: center;
            align-items: center;
        }

        .logo {
            font-size: 50px;
            font-weight: bold;
            color: #6b4f2f;
            margin-top: 20px;
        }

        h1 {
            color: #6b4f2f;
            font-size: 36px;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 350px;
            width: 100%;
        }

        .form-container h2 {
            color: #6b4f2f;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #4a4a4a;
        }

        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container button {
            margin-top: 15px;
            background-color: #6b4f2f;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-container button:hover {
            background-color: #563d25;
        }

        .message {
            margin: 15px 0;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

    <div class="logo">Coffee House</div>

    <div class="form-container">
        <h2>Update Menu Item</h2>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($item['name']) ?>" required>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?= htmlspecialchars($item['price']) ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?= htmlspecialchars($item['description']) ?></textarea>

            <button type="submit">Update Item</button>
        </form>
    </div>

</body>
</html>

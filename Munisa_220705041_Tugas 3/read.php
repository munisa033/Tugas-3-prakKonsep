<?php
require 'db.php';

$sql = "SELECT * FROM menu";
$stmt = $pdo->query($sql);
$menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu List</title>
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

        .menu-container {
            width: 90%;
            max-width: 900px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        table th {
            background-color: #6b4f2f;
            color: white;
            font-size: 18px;
        }

        table td {
            font-size: 16px;
        }

        a {
            text-decoration: none;
            color: #6b4f2f;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        a:hover {
            background-color: #6b4f2f;
            color: white;
        }

        .actions a {
            margin: 0 5px;
        }

        .add-item {
            margin: 20px 0;
            display: inline-block;
            padding: 10px 20px;
            background-color: #6b4f2f;
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .add-item:hover {
            background-color: #563d25;
        }
    </style>
</head>
<body>

    <div class="logo">Coffee House</div>

    <div class="menu-container">
        <h1>Menu List</h1>
        <a href="create.php" class="add-item">Add New Item</a>
        


        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($menuItems as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['id']) ?></td>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= htmlspecialchars($item['price']) ?></td>
                <td><?= htmlspecialchars($item['description']) ?></td>
                <td class="actions">
                    <a href="update.php?id=<?= $item['id'] ?>">Edit</a> |
                    <a href="delete.php?id=<?= $item['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>
</html>

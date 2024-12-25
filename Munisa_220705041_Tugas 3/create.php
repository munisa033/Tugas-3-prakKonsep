<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "INSERT INTO menu (name, price, description) VALUES (:name, :price, :description)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':name' => $name,
            ':price' => $price,
            ':description' => $description,
        ]);
        $success_message = "Menu item added successfully!";
    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Menu Item</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css">
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
}

.logo {
    font-size: 50px;
    font-weight: bold;
    color: #6b4f2f;
    margin-left: 20px; /* Geser logo ke kiri */
    margin-top: 20px; /* Beri jarak dari atas */
}

main {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 20px;
}

.form-container {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    max-width: 380px;
    width: 100%;
}

.form-container h2 {
    color: #6b4f2f;
    margin-bottom: 20px;
    font-size: 24px;
}

.form-container label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
    color: #4a4a4a;
}

.form-container input, .form-container textarea {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    box-sizing: border-box;
}

.form-container textarea {
    resize: vertical;
}

.form-container button {
    margin-top: 20px;
    background-color: #6b4f2f;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.form-container button:hover {
    background-color: #563d25;
    transform: scale(1.05);
}

.message {
    margin: 15px 0;
    padding: 15px;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
    width: 100%;
    box-sizing: border-box;
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

/* Gaya untuk tautan dengan class add-item */
.add-item {
    color:  #6b4f2f; /* Sesuaikan dengan warna yang digunakan di read.php */
    text-decoration: none;
    font-weight: bold; /* Bisa dihapus jika tidak diperlukan */
    padding: 8px 12px;
    border-radius: 4px;
    transition: background-color 0.3s, color 0.3s;
}

/* Hover effect untuk pengalaman pengguna lebih baik */
.add-item:hover {
    color: white;
    background-color:  #6b4f2f; /* Warna lebih gelap sebagai hover */
}



    </style>
</head>
<body>
    <header>
        <div class="logo">Coffee House</div>
    </header>

    <main>
        <div class="form-container">
            <h2>Create Menu Item</h2>
            <?php if (isset($success_message)): ?>
                <div class="message success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <?php if (isset($error_message)): ?>
                <div class="message error"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <a href="read.php" class="add-item">View Menu List</a>

            <form method="POST" action="">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="5" required></textarea>

                <button type="submit">Add Menu Item</button>
            </form>
        </div>
    </main>
</body>
</html>

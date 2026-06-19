<?php

require_once __DIR__ . '/helpers/auth.php';
requireAdmin();

require_once __DIR__ . '/classes/Db.php';

$pdo = Db::connect();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $subCategory = trim($_POST['subCategory']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'] ?? 0;
    $disposability = isset($_POST['disposability']) ? 1 : 0;
    $stock = $_POST['stock'] ?? 0;
    
    // UPLOAD IMMAGINE
  
    $imagePath = null;

    if (!empty($_FILES['image']['name'])) {

        $uploadDir = 'uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $fileName;

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {

            move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
            $imagePath = $targetFile;

        } else {

            $error = "Formato immagine non valido";

        }
    }

    // VALIDAZIONE BASE

    if ($name === '' || $price === '') {

        $error = "Nome e prezzo sono obbligatori";

    }

    // INSERT DB

    if (!$error) {

        $stmt = $pdo->prepare("
            INSERT INTO prodotti
            (name, category, subCategory, price, disposability, image_path)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $name,
            $category,
            $subCategory,
            $price,
            $disposability,
            $imagePath
        ]);

        header("Location: admin.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="it">

<head>

    <meta charset="UTF-8">
    <title>Aggiungi Prodotto</title>

    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">

</head>

<body class="bg-light">

<div class="container py-5">

    <h2 class="mb-4">Aggiungi Prodotto</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">

         <!-- FOTO -->
        <label class="form-label">Foto Prodotto</label>
        <input type="file"
            name="image"
            class="form-control mb-3"
            accept="image/*">

        <!-- NOME -->
        <label class="form-label">Nome Prodotto</label>
        <input type="text"
            name="name"
            class="form-control mb-3"
            placeholder="Nome prodotto"
            required>

        <!-- CATEGORIA -->
        <label class="form-label">Categoria</label>
        <input type="text"
            name="category"
            class="form-control mb-3"
            placeholder="Categoria">

        <!-- SOTTOCATEGORIA -->
        <label class="form-label">Sottocategoria</label>
        <input type="text"
            name="subCategory"
            class="form-control mb-3"
            placeholder="Sottocategoria">

        <!-- QUANTITÀ (litri / grammi) -->
        <label class="form-label">Quantità</label>
        <input type="number"
            step="0.01"
            name="quantity"
            class="form-control mb-3"
            placeholder="Quantità (es. 0.75 L / 5 kg)">

        <!-- STOCK -->
        <label class="form-label">Stock</label>
        <input type="number"
            name="stock"
            class="form-control mb-3"
            placeholder="Quantità disponibile (stock)"
            min="0">

        <!-- PREZZO -->
        <label class="form-label">Prezzo</label>
        <input type="number"
            step="0.01"
            name="price"
            class="form-control mb-3"
            placeholder="Prezzo"
            required>

        <!-- DISPONIBILITÀ -->
        <div class="form-check mb-3">

            <input type="checkbox"
                name="disposability"
                class="form-check-input"
                id="disp"
                checked>

            <label class="form-check-label" for="disp">
                Disponibile
            </label>

        </div>

        <button class="btn btn-success w-100">
            Salva prodotto
        </button>

    </form>

</div>

</body>
</html>
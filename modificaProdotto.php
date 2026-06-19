<?php

require_once __DIR__ . '/helpers/auth.php';
requireAdmin();

require_once __DIR__ . '/classes/Db.php';

$pdo = Db::connect();

$id = $_GET['id'] ?? null;

$stmt = $pdo->prepare("SELECT * FROM prodotti WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $category = $_POST['category'];
    $subCategory = $_POST['subCategory'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $stock = $_POST['stock'];
    $disposability = isset($_POST['disposability']) ? 1 : 0;

    $stmt = $pdo->prepare("
        UPDATE prodotti
        SET 
            name = ?, 
            category = ?, 
            subCategory = ?, 
            quantity = ?, 
            stock = ?, 
            price = ?, 
            disposability = ?
        WHERE id = ?
    ");

    $stmt->execute([
        $name,
        $category,
        $subCategory,
        $quantity,
        $stock,
        $price,
        $disposability,
        $id
    ]);

    header("Location: admin.php");
    exit;
}

include 'header.php';
?>

<div class="container py-5">

    <h2>Modifica Prodotto</h2>

    <form method="POST" class="card p-4 shadow-sm mt-4">

        <!-- NOME -->
        <input type="text"
            name="name"
            class="form-control mb-3"
            value="<?= htmlspecialchars($product['name']) ?>"
            required>

        <!-- CATEGORIA -->
        <input type="text"
            name="category"
            class="form-control mb-3"
            value="<?= htmlspecialchars($product['category']) ?>">

        <!-- SOTTOCATEGORIA -->
        <input type="text"
            name="subCategory"
            class="form-control mb-3"
            value="<?= htmlspecialchars($product['subCategory']) ?>">

        <!-- QUANTITÀ -->
        <input type="number"
            step="0.01"
            name="quantity"
            class="form-control mb-3"
            value="<?= $product['quantity'] ?>"
            placeholder="Quantità (L / Kg)">

        <!-- STOCK -->
        <input type="number"
            name="stock"
            class="form-control mb-3"
            value="<?= $product['stock'] ?>"
            placeholder="Stock">

        <!-- PREZZO -->
        <input type="number"
            step="0.01"
            name="price"
            class="form-control mb-3"
            value="<?= $product['price'] ?>"
            required>

        <!-- DISPONIBILITÀ -->
        <div class="form-check mb-3">

            <input type="checkbox"
                name="disposability"
                class="form-check-input"
                <?= $product['disposability'] ? 'checked' : '' ?>>

            <label class="form-check-label">
                Disponibile
            </label>

        </div>

        <button class="btn btn-primary w-100">
            Aggiorna prodotto
        </button>

    </form>

</div>

<?php include 'footer.php'; ?>
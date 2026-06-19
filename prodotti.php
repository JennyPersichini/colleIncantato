<?php

require_once __DIR__ . '/classes/Db.php';

$pdo = Db::connect();

$stmt = $pdo->query("
    SELECT *
    FROM prodotti
    ORDER BY category, name
");

$prodotti = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'headerLoad.php';

?>

<main class="py-5">

    <div class="container">

        <h1 class="text-center mb-3">
            I nostri prodotti
        </h1>

        <p class="text-center text-muted mb-5">
            Vini, oli, formaggi e prodotti tipici della nostra tenuta
        </p>

        <div class="row g-4">

            <?php if (count($prodotti) > 0): ?>

                <?php foreach ($prodotti as $p): ?>

                    <div class="col-md-4">

                        <div class="card card-hover h-100 shadow-sm border-0">

                            <!-- IMMAGINE -->
                            <?php if (!empty($p['image_path'])): ?>

                                <img src="<?= htmlspecialchars($p['image_path']) ?>"
                                     class="card-img-top"
                                     style="height: 220px; object-fit: cover;"
                                     alt="prodotto">

                            <?php else: ?>

                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                     style="height: 220px;">

                                    Nessuna immagine

                                </div>

                            <?php endif; ?>

                            <!-- BODY -->
                            <div class="card-body">

                                <div class="bg-white border-0 pt-0 text-end">

                                    <?php if ($p['disposability']): ?>

                                        <span class="badge bg-success">
                                            Disponibile
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-danger">
                                            Non disponibile
                                        </span>

                                    <?php endif; ?>

                                </div>

                                <h5 class="card-title mb-1">
                                    <?= htmlspecialchars($p['name']) ?>
                                </h5>

                                <p class="text-muted mb-2">
                                    <i class="fa-solid fa-tag"></i>
                                    <?= htmlspecialchars($p['category']) ?>
                                    
                                    <?php if (!empty($p['subCategory'])): ?>
                                        → <?= htmlspecialchars($p['subCategory']) ?>
                                    <?php endif; ?>
                                </p>

                                <!-- QUANTITÀ -->
                                <?php if (isset($p['quantity'])): ?>
                                    <p class="mb-1">
                                        Quantità:
                                        <strong><?= htmlspecialchars($p['quantity']) ?></strong> litri/grammi
                                    </p>
                                <?php endif; ?>

                            </div>

                            <!-- PREZZO -->
                            <h2 class="text-success fw-bold mb-3 text-center">
                                <?= number_format($p['price'], 2) ?> €
                            </h2>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="col-12 text-center text-muted">
                    Nessun prodotto disponibile
                </div>

            <?php endif; ?>

        </div>

    </div>

</main>

<?php include 'footer.php'; ?>
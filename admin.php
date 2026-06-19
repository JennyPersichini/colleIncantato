<?php

require_once __DIR__ . '/helpers/auth.php';
requireAdmin();

require_once __DIR__ . '/classes/Booking.php';
require_once __DIR__ . '/classes/Product.php';

$user = currentUser();

$prenotazioni = Booking::findAll();
$prodotti = Product::findAll();

?>

<!DOCTYPE html>
<html lang="it">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Admin</title>

        <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    </head>

    <body class="bg-light">

    <div class="container-fluid">

        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-lg-2 bg-dark text-white min-vh-100">

                <div class="text-center py-4">

                    <img src="assets/images/logo2.png" class="rounded-circle mb-3" width="120">

                    <h4><?= htmlspecialchars($user['name']) ?></h4>

                    <p class="text-secondary">Amministratore</p>

                    <hr>

                </div>

                <ul class="nav flex-column">

                    <li class="nav-item mb-2">
                        <a href="admin.php" class="nav-link text-white">
                            <i class="fa-solid fa-house"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a href="#prenotazioni" class="nav-link text-white">
                            <i class="fa-regular fa-calendar"></i> Prenotazioni
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a href="#prodotti" class="nav-link text-white">
                            <i class="fa-solid fa-wine-bottle"></i> Prodotti
                        </a>
                    </li>

                    <li class="nav-item mt-5">
                        <a href="logout.php" class="btn btn-light w-100">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                    </li>

                </ul>

            </div>

            <!-- CONTENUTO -->
            <div class="col-lg-10 p-5">

                <h1 class="mb-5">Dashboard Amministratore</h1>

                <!-- CARD -->
                <div class="row mb-5">

                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h5>Prenotazioni</h5>
                                <h2><?= count($prenotazioni) ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h5>Prodotti</h5>
                                <h2><?= count($prodotti) ?></h2>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- PRENOTAZIONI -->
                <div class="card shadow-sm mb-5" id="prenotazioni">

                    <div class="card-body">

                        <h3 class="mb-4">Prenotazioni Clienti</h3>

                        <table class="table table-hover align-middle">

                            <thead>

                            <tr>
                                <th>Cliente</th>
                                <th>Email</th>
                                <th>Data</th>
                                <th>Tipo</th>
                                <th>Persone</th>
                                <th>Messaggio</th>
                                <th>Stato</th>
                                <th>Azioni</th>
                            </tr>

                            </thead>

                            <tbody>

                            <?php if (!empty($prenotazioni)): ?>

                                <?php foreach ($prenotazioni as $p): ?>

                                    <tr>

                                        <td>
                                            <?= htmlspecialchars($p['nome']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($p['email']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($p['data_evento']) ?>
                                        </td>

                                        <td>
                                            <?= ucfirst($p['tipo']) ?>
                                        </td>

                                        <td>
                                            <?= (int)$p['numero_persone'] ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($p['messaggio'] ?: '-') ?>
                                        </td>

                                        <td>

                                            <?php if ($p['stato'] === 'in_attesa'): ?>

                                                <span class="badge bg-warning text-dark">
                                                    In attesa
                                                </span>

                                            <?php elseif ($p['stato'] === 'confermata'): ?>

                                                <span class="badge bg-success">
                                                    Confermata
                                                </span>

                                            <?php else: ?>

                                                <span class="badge bg-danger">
                                                    Rifiutata
                                                </span>

                                            <?php endif; ?>

                                        </td>

                                        <td>

                                            <?php if ($p['stato'] === 'in_attesa'): ?>

                                                <a
                                                    href="updateBookingStatus.php?id=<?= $p['id'] ?>&status=confermata"
                                                    class="btn btn-success btn-sm">

                                                    <i class="fa-solid fa-check"></i>

                                                </a>

                                                <a
                                                    href="updateBookingStatus.php?id=<?= $p['id'] ?>&status=rifiutata"
                                                    class="btn btn-danger btn-sm">

                                                    <i class="fa-solid fa-xmark"></i>

                                                </a>

                                            <?php else: ?>

                                                <span class="text-muted">
                                                    Nessuna azione
                                                </span>

                                            <?php endif; ?>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="8" class="text-center text-muted">

                                        Nessuna prenotazione disponibile.

                                    </td>

                                </tr>

                            <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

                <!-- PRODOTTI -->
                <div class="card shadow-sm" id="prodotti">

                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-4">

                            <h3>Prodotti</h3>

                            <a href="aggiungiProdotto.php" class="btn btn-success">
                                <i class="fa-solid fa-plus"></i> Aggiungi prodotto
                            </a>

                        </div>

                        <table class="table table-striped align-middle">

                            <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Sottocategoria</th>
                                <th>Quantità (Litri / kg)</th>
                                <th>Stock</th>
                                <th>Prezzo</th>
                                <th>Stato</th>
                                <th>Azioni</th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php if (count($prodotti) > 0): ?>

                                <?php foreach ($prodotti as $p): ?>

                                    <tr>

                                        <!-- FOTO -->
                                        <td>
                                            <?php if (!empty($p['image_path'])): ?>
                                                <img src="<?= htmlspecialchars($p['image_path']) ?>"
                                                    style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                            <?php else: ?>
                                                <span class="text-muted">No img</span>
                                            <?php endif; ?>
                                        </td>

                                        <td><?= htmlspecialchars($p['name']) ?></td>
                                        <td><?= htmlspecialchars($p['category']) ?></td>
                                        <td><?= htmlspecialchars($p['subCategory']) ?></td>

                                        <td><?= $p['quantity'] ?></td>

                                        <td>
                                            <?php if ($p['stock'] > 0): ?>
                                                <span class="badge bg-primary"><?= $p['stock'] ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Esaurito</span>
                                            <?php endif; ?>
                                        </td>

                                        <td><?= number_format($p['price'], 2) ?> €</td>

                                        <td>
                                            <?php if ($p['disposability'] && $p['stock'] > 0): ?>
                                                <span class="badge bg-success">Disponibile</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Non disponibile</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>

                                            <a href="modificaProdotto.php?id=<?= $p['id'] ?>"
                                            class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <a href="cancellaProdotto.php?id=<?= $p['id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Eliminare prodotto?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>
                                    <td colspan="9" class="text-center text-muted">
                                        Nessun prodotto disponibile.
                                    </td>
                                </tr>

                            <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
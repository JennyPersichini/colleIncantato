<?php

require_once __DIR__ . '/helpers/auth.php';

requireAdmin();



$user = currentUser();

?>


<!DOCTYPE html>
<html lang="it">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

</head>

<body class="bg-light">

<div class="container-fluid">

    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-lg-2 bg-dark text-white min-vh-100">

            <div class="text-center py-4">

                <img src="assets/images/logo2.png"
                     class="rounded-circle mb-3"
                     width="120">

                <h4>
                    <?= htmlspecialchars($user['name']) ?>
                </h4>

                <p class="text-secondary">
                    Amministratore
                </p>

                <hr>

            </div>

            <ul class="nav flex-column">

                <li class="nav-item mb-2">

                    <a href="admin.php" class="nav-link text-white">

                        <i class="fa-solid fa-house"></i>

                        Dashboard

                    </a>

                </li>


                <li class="nav-item mb-2">

                    <a href="#" class="nav-link text-white">

                        <i class="fa-regular fa-calendar"></i>

                        Prenotazioni

                    </a>

                </li>


                <li class="nav-item mb-2">

                    <a href="#" class="nav-link text-white">

                        <i class="fa-solid fa-wine-bottle"></i>

                        Prodotti

                    </a>

                </li>


                <li class="nav-item mt-5">

                    <a href="logout.php" class="btn btn-light w-100">

                        <i class="fa-solid fa-right-from-bracket"></i>

                        Logout

                    </a>

                </li>

            </ul>

        </div>


        <!-- CONTENUTO -->
        <div class="col-lg-10 p-5">

            <h1 class="mb-5">

                Dashboard Amministratore

            </h1>


            <!-- CARD -->
            <div class="row mb-5">

                <div class="col-md-6">

                    <div class="card shadow-sm">

                        <div class="card-body text-center">

                            <h5>Prenotazioni</h5>

                            <h2></h2>

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="card shadow-sm">

                        <div class="card-body text-center">

                            <h5>Prodotti</h5>

                            <h2></h2>

                        </div>

                    </div>

                </div>

            </div>


            <!-- PRENOTAZIONI -->
            <div class="card shadow-sm mb-5">

                <div class="card-body">

                    <h3 class="mb-4">

                        Prenotazioni Clienti

                    </h3>

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th>Cliente</th>
                                <th>Data</th>
                                <th>Tipo</th>
                                <th>Persone</th>
                                <th>Stato</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td colspan="5" class="text-center text-muted">

                                    Nessuna prenotazione disponibile.

                                </td>

                            </tr>

                         </tbody>

                    </table>

                </div>

            </div>


            <!-- PRODOTTI -->
            <div class="card shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-4">

                        <h3>

                            Prodotti

                        </h3>

                        <button class="btn btn-success">

                            <i class="fa-solid fa-plus"></i>

                            Aggiungi prodotto

                        </button>

                    </div>


                    <table class="table table-striped">

                        <thead>

                        <tr>

                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Prezzo</th>
                            <th>Azioni</th>

                        </tr>

                        </thead>

                        <tbody>

                            <tr>

                                    <td colspan="4" class="text-center text-muted">

                                        Nessun prodotto disponibile.

                                    </td>

                            </tr>

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
<?php
require_once __DIR__ . '/helpers/auth.php';
startSession();
?>

<!DOCTYPE html>
<html lang="it">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/style.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <link rel="stylesheet"
          href="./node_modules/bootstrap/dist/css/bootstrap.min.css">

    <title>Colle Incantato</title>

</head>

<body>

<header>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">

    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">

            <img
                src="assets/images/logo.png"
                alt="Colle Incantato"
                class="logo">

            <div class="brand-text">

                <span class="brand-title">
                    Tenuta Agricola
                </span>

                <span class="brand-subtitle">
                    Colle Incantato
                </span>

            </div>

        </a>


        <!-- MENU MOBILE -->
        <button
            class="navbar-toggler"
            data-bs-toggle="collapse"
            data-bs-target="#menu">

            <span class="navbar-toggler-icon"></span>

        </button>


        <div class="collapse navbar-collapse" id="menu">

            <!-- MENU -->
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">

                    <a class="nav-link" href="index.php">
                        Home
                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="prodotti.php">
                        I nostri prodotti
                    </a>

                </li>

            </ul>


            <!-- ICONE -->
            <div class="ms-4 d-flex align-items-center gap-4">

                <!-- CARRELLO -->
                <a href="carrello.php"
                   class="login-icon">

                    <i class="fa-solid fa-cart-shopping"></i>

                </a>


                <!-- DASHBOARD -->
                <a href="dashboard.php"
                   class="login-icon">

                    <i class="fa-solid fa-user"></i>

                </a>


                <!-- LOGOUT -->
                <a href="logout.php"
                   class="login-icon">

                    <i class="fa-solid fa-right-from-bracket"></i>

                </a>

            </div>

        </div>

    </div>

</nav>

</header>
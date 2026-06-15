<?php

require_once __DIR__ . '/helpers/auth.php';

requireLogin();

$user = currentUser();

include 'header.php';

?>

<section class="py-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <!-- Profilo -->
                <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <h2 class="mb-4">
                            <i class="fa-regular fa-user"></i>
                            Area Personale
                        </h2>

                        <hr>

                        <h4>
                            Benvenuto!!!
                        </h4>

                    </div>

                </div>


                <!-- Prenotazioni -->
                <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <h3>
                            <i class="fa-regular fa-calendar"></i>
                            Le mie prenotazioni
                        </h3>

                        <hr>

                        <p class="text-muted">
                            Nessuna prenotazione disponibile.
                        </p>

                    </div>

                </div>


                <!-- Ordini -->
                <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <h3>
                            <i class="fa-solid fa-wine-glass"></i>
                            I miei ordini
                        </h3>

                        <hr>

                        <p class="text-muted">
                            Nessun ordine effettuato.
                        </p>

                    </div>

                </div>


                <!-- Logout -->
                <div class="text-center">

                    <a href="logout.php"
                       class="btn btn-danger">

                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include 'footer.php'; ?>
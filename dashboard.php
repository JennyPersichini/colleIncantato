<?php

require_once __DIR__ . '/helpers/auth.php';

requireLogin();

require_once __DIR__ . '/classes/Booking.php';

$user = currentUser();

$prenotazioni = Booking::findByEmail($user['email']);

include 'header.php';

?>

<section class="py-5">

    <div class="container">

        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-lg-3 mb-4">

                <div class="card shadow-sm">

                    <div class="card-body text-center">

                        <!-- FOTO PROFILO -->
                        <img
                            src="assets/images/avatar.png"
                            class="rounded-circle img-fluid mb-3"
                            style="width:150px;height:150px;object-fit:cover;"
                            alt="Profilo">

                        <h4>
                            <?= htmlspecialchars($user['name']) ?>
                        </h4>

                        <p class="text-muted">
                            <?= htmlspecialchars($user['email']) ?>
                        </p>

                        <hr>

                        <a href="logout.php"
                           class="btn btn-outline-dark">

                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout

                        </a>

                    </div>

                </div>

            </div>


            <!-- CONTENUTO -->
            <div class="col-lg-9">

                <!-- PRENOTAZIONI -->
                <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <h3 class="mb-4">

                            <i class="fa-regular fa-calendar"></i>
                            Le mie prenotazioni

                        </h3>

                        <hr>

                        <p class="text-muted">

                            Nessuna prenotazione disponibile.

                        </p>

                    </div>

                </div>


                <!-- ORDINI -->
                <div class="card shadow-sm">

                    <div class="card-body">

                        <h3 class="mb-4">

                            <i class="fa-solid fa-cart-shopping"></i>
                            I miei ordini

                        </h3>

                        <hr>

                        <p class="text-muted">

                            Nessun ordine effettuato.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include 'footer.php'; ?>
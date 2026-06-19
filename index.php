<?php

require_once __DIR__ . '/helpers/auth.php';
require_once __DIR__ . '/classes/Booking.php';

startSession();

$user = currentUser();

$error = null;
$success = null;

// GESTIONE PRENOTAZIONE

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {

        Booking::create(
            $_POST['nome'],
            $_POST['email'],
            $_POST['data_evento'],
            $_POST['tipo'],
            (int) $_POST['numero_persone'],
            $_POST['messaggio'] ?? ''
        );

        $success = "Prenotazione inviata con successo";

    } catch (Exception $e) {

        $error = $e->getMessage();
    }
}

include 'headerLoad.php';

?>

<main>

    <!-- HERO -->
    <section>
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img src="assets/images/hero1.png" class="d-block w-100" alt="Agriturismo">
                </div>

                <div class="carousel-item">
                    <img src="assets/images/hero2.png" class="d-block w-100" alt="Vigneti">
                </div>

                <div class="carousel-item">
                    <img src="assets/images/hero3.png" class="d-block w-100" alt="Degustazioni">
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

        </div>
    </section>


    <!-- STORIA -->
    <section class="storia py-5">
        <div class="container text-center">

            <h2 class="mb-4">Benvenuti nel nostro agriturismo</h2>

            <p class="lead">
                Un luogo dove tradizione, natura e sapori autentici si incontrano.
            </p>

            <p>
                Da generazioni coltiviamo la terra con passione, producendo vino,
                olio, formaggi e miele nel rispetto della natura e delle tradizioni locali.
            </p>

            <a href="storia.php" class="btn btn-success mt-3">
                Scopri la nostra storia
            </a>

        </div>
    </section>


    <!-- EVENTI -->
    <section class="py-5">
        <div class="container">

            <h2 class="text-center mb-5">Eventi e esperienze</h2>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card card-hover shadow-sm h-100">
                        <img src="assets/images/degustazione.png" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5>Degustazione vini</h5>
                            <p>Assapora i nostri vini con prodotti tipici locali.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-hover shadow-sm h-100">
                        <img src="assets/images/caseificio.png" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5>Laboratorio formaggi</h5>
                            <p>Scopri come nasce il formaggio tradizionale.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-hover shadow-sm h-100">
                        <img src="assets/images/vigneti.png" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5>Visita ai vigneti</h5>
                            <p>Passeggiata tra le vigne e degustazione finale.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- PRENOTAZIONE -->
    <section class="py-5 bg-light">

        <div class="container">

            <h2 class="text-center mb-3">Prenota la tua esperienza</h2>

            <?php if ($error): ?>
                <div class="alert alert-danger text-center">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success text-center">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <div class="row justify-content-center">

                <div class="col-lg-8">

                    <form method="POST" class="p-4 bg-white shadow rounded">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" class="form-control"
                                       value="<?= htmlspecialchars($user['name'] ?? '') ?>"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="<?= htmlspecialchars($user['email'] ?? '') ?>"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Data</label>
                                <input type="date" name="data_evento" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Numero Persone</label>
                                <input type="number" name="numero_persone" class="form-control" required>
                            </div>

                            <div class="col-12">
                                <select name="tipo" class="form-select" required>
                                    <option value="">Seleziona un'opzione</option>
                                    <option value="pranzo">Pranzo</option>
                                    <option value="cena">Cena</option>
                                    <option value="evento">Evento</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <textarea name="messaggio" class="form-control" rows="4" placeholder="Allergie, richieste, esigenze..."></textarea>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success px-5">
                                    Prenota ora
                                </button>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>


    <!-- PRODOTTI -->
    <section class="py-5 bg-light">

        <div class="container">

            <h2 class="text-center mb-5">I nostri prodotti</h2>

            <div class="row g-4">

                <div class="col-md-3">
                    <div class="card card-hover h-100 shadow-sm">
                        <img src="assets/images/vino.png" class="card-img-top" alt="">
                        <div class="card-body text-center">
                            <h5>Vini</h5>
                            <p class="text-muted">Vini rossi e bianchi della tradizione.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-hover h-100 shadow-sm">
                        <img src="assets/images/olio.png" class="card-img-top" alt="">
                        <div class="card-body text-center">
                            <h5>Olio EVO</h5>
                            <p class="text-muted">Spremitura a freddo di alta qualità.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-hover h-100 shadow-sm">
                        <img src="assets/images/formaggi.png" class="card-img-top" alt="">
                        <div class="card-body text-center">
                            <h5>Formaggi</h5>
                            <p class="text-muted">Lavorazione artigianale locale.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-hover h-100 shadow-sm">
                        <img src="assets/images/miele.png" class="card-img-top" alt="">
                        <div class="card-body text-center">
                            <h5>Miele</h5>
                            <p class="text-muted">Produzione naturale e biologica.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-center mt-4">
                <a href="prodotti.php" class="btn btn-outline-success">
                    Vedi tutti i prodotti
                </a>
            </div>

        </div>

    </section>

</main>

<?php include 'footer.php'; ?>
<?php include 'header.php'?>

<main>

    <!-- Hero Carousel -->
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

    <!-- Storia -->
    <section class="py-5">

        <div class="container text-center">

            <h2 class="mb-3">Benvenuti nel nostro agriturismo</h2>

            <p class="lead text-muted">
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

    <!-- Eventi -->
    <section class="py-5">

        <div class="container">

            <h2 class="text-center mb-5">Eventi e esperienze</h2>

            <div class="row g-4">

                <div class="col-md-4">

                    <div class="card shadow-sm h-100">

                        <img src="assets/images/evento1.jpg" class="card-img-top" alt="">

                        <div class="card-body">
                            <h5>Degustazione vini</h5>
                            <p>Assapora i nostri vini con prodotti tipici locali.</p>
                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card shadow-sm h-100">

                        <img src="assets/images/evento2.jpg" class="card-img-top" alt="">

                        <div class="card-body">
                            <h5>Laboratorio formaggi</h5>
                            <p>Scopri come nasce il formaggio tradizionale.</p>
                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card shadow-sm h-100">

                        <img src="assets/images/evento3.jpg" class="card-img-top" alt="">

                        <div class="card-body">
                            <h5>Visita ai vigneti</h5>
                            <p>Passeggiata tra le vigne e degustazione finale.</p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Prenotazioni -->
    <section class="py-5 bg-light">

        <div class="container">

            <h2 class="text-center mb-3">Prenota la tua esperienza</h2>

            <p class="text-center text-muted mb-5">
                Scegli tra visite, attività in fattoria oppure pranzo e cena con prodotti tipici.
            </p>

            <div class="row justify-content-center">

                <div class="col-lg-8">

                    <form class="p-4 bg-white shadow rounded">

                        <div class="row g-3">

                            <!-- Nome -->
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Nome" required>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email" required>
                            </div>

                            <!-- Data -->
                            <div class="col-md-6">
                                <input type="date" class="form-control" required>
                            </div>

                            <!-- Persone -->
                            <div class="col-md-6">
                                <input type="number" class="form-control" placeholder="Numero persone" required>
                            </div>

                            <!-- Tipo prenotazione -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Tipo di prenotazione</label>

                                <select class="form-select" required>
                                    <option value="">Seleziona un'opzione</option>
                                    <option value="esperienza">Esperienza / Attività in fattoria</option>
                                    <option value="pranzo">Pranzo</option>
                                    <option value="cena">Cena</option>
                                </select>
                            </div>

                            <!-- Messaggio -->
                            <div class="col-12">
                                <textarea class="form-control" rows="4"
                                        placeholder="Richieste particolari (menu, allergie, ecc.)"></textarea>
                            </div>

                            <!-- Button -->
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

    <!-- Prodotti -->
    <section class="py-5 bg-light">

        <div class="container">

            <h2 class="text-center mb-5">I nostri prodotti</h2>

            <div class="row g-4">

                <div class="col-md-3">

                    <div class="card h-100 shadow-sm">
                        <img src="assets/images/vino.jpg" class="card-img-top" alt="">
                        <div class="card-body text-center">
                            <h5>Vini</h5>
                            <p class="text-muted">Vini rossi e bianchi della tradizione.</p>
                        </div>
                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card h-100 shadow-sm">
                        <img src="assets/images/olio.jpg" class="card-img-top" alt="">
                        <div class="card-body text-center">
                            <h5>Olio EVO</h5>
                            <p class="text-muted">Spremitura a freddo di alta qualità.</p>
                        </div>
                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card h-100 shadow-sm">
                        <img src="assets/images/formaggi.jpg" class="card-img-top" alt="">
                        <div class="card-body text-center">
                            <h5>Formaggi</h5>
                            <p class="text-muted">Lavorazione artigianale locale.</p>
                        </div>
                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card h-100 shadow-sm">
                        <img src="assets/images/miele.jpg" class="card-img-top" alt="">
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


<?php include 'footer.php'?>
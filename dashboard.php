<?php

require_once __DIR__ . '/helpers/auth.php';
requireLogin();

require_once __DIR__ . '/classes/Booking.php';

$user = currentUser();

$prenotazioni = Booking::findByEmail($user['email']);

include 'headerUtente.php';

?>

<section class="py-5">

    <div class="container">

        <div class="row">

            <!-- SIDEBAR PROFILO -->
            <div class="col-lg-3 mb-4">

                <div class="card shadow-sm">

                    <div class="card-body text-center">

                        <img src="assets/images/avatar.png"
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

                        <a href="logout.php" class="btn btn-outline-dark w-100">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </a>

                    </div>

                </div>

            </div>

            <!-- CONTENUTO -->
            <div class="col-lg-9">

                <!-- ORDINI -->
                <div class="card shadow-sm m-3">

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

                <!-- PRENOTAZIONI -->
                <div class="card shadow-sm mb-4 m-3">

                    <div class="card-body">

                        <h3 class="mb-4">
                            <i class="fa-regular fa-calendar"></i>
                            Le mie prenotazioni
                        </h3>

                        <hr>

                        <?php if (count($prenotazioni) > 0): ?>

                            <div class="table-responsive">

                                <table class="table table-striped align-middle">

                                    <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Tipo</th>
                                        <th>Persone</th>
                                        <th>Messaggio</th>
                                        <th>Stato</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <?php foreach ($prenotazioni as $p): ?>

                                        <tr>

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

                                        </tr>

                                    <?php endforeach; ?>

                                    </tbody>

                                </table>

                            </div>

                        <?php else: ?>

                            <p class="text-muted">
                                Nessuna prenotazione disponibile.
                            </p>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include 'footer.php'; ?>


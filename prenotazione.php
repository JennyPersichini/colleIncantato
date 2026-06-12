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
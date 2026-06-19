<?php

require_once __DIR__ . '/classes/Db.php';

$pdo = Db::connect();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $data_evento = $_POST['data_evento'];
    $numero_persone = (int) $_POST['numero_persone'];
    $tipo = $_POST['tipo'];
    $messaggio = trim($_POST['messaggio'] ?? '');

    if ($nome === '' || $email === '' || $data_evento === '' || $numero_persone <= 0 || $tipo === '') {
        $error = "Compila tutti i campi";
    }

    if (!$error) {

        $stmt = $pdo->prepare("
            INSERT INTO prenotazioni
            (nome, email, data_evento, numero_persone, tipo, messaggio)
            VALUES (:nome, :email, :data_evento, :numero_persone, :tipo, :messaggio)
        ");

        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':data_evento' => $data_evento,
            ':numero_persone' => $numero_persone,
            ':tipo' => $tipo,
            ':messaggio' => $messaggio
        ]);

        header("Location: index.php?success=1");
        exit;
    }
}
?>

<section class="py-5 bg-light">

    <div class="container">

        <h2 class="text-center mb-3">Prenota la tua esperienza</h2>

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="p-4 bg-white shadow rounded">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                        </div>

                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>

                        <div class="col-md-6">
                            <input type="date" name="data_evento" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <input type="number" name="numero_persone" class="form-control" placeholder="Numero persone" required>
                        </div>

                        <div class="col-12">

                            <select name="tipo" class="form-select" required>

                                <option value="">Seleziona un'opzione</option>
                                <option value="esperienza">Esperienza</option>
                                <option value="pranzo">Pranzo</option>
                                <option value="cena">Cena</option>

                            </select>

                        </div>

                        <div class="col-12">
                            <textarea name="messaggio" class="form-control" rows="4"
                                    placeholder="Richieste particolari"></textarea>
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
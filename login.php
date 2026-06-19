<?php

session_start();

require_once __DIR__ . '/classes/Db.php';

$errors = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recupero dati dal form
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validazione
    if ($email === '' || $password === '') {

        $errors = 'Email e password sono obbligatorie.';

    } else {

        // Connessione al database
        $pdo = Db::connect();

        // Ricerca utente
        $stmt = $pdo->prepare(
            'SELECT id, name, email, password, role
             FROM users
             WHERE email = :email'
        );

        $stmt->execute([
            ':email' => $email
        ]);

        $user = $stmt->fetch();

        // Verifica password
        if ($user && password_verify($password, $user['password'])) {

            // Rigenera l'ID di sessione
            session_regenerate_id(true);

            // Salva i dati in sessione
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];

            // Reindirizza in base al ruolo
            if ($user['role'] === 'admin') {

                header('Location: admin.php');

            } else {

                header('Location: index.php');

            }

            exit;


        }

        $errors = 'Credenziali non valide.';
    }
}

include 'header.php';
?>

<main class="py-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-5">

                <div class="card shadow-lg border-0 rounded-4">

                    <div class="card-body p-5">

                        <h2 class="text-center text-success fw-bold mb-4">
                            Accedi
                        </h2>

                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <?= htmlspecialchars($errors) ?>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST">

                            <div class="mb-3">

                                <label for="email" class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                                    placeholder="Inserisci la tua email"
                                    required>

                            </div>

                            <div class="mb-4">

                                <label for="password" class="form-label">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="Inserisci la password"
                                    required>

                            </div>

                            <div class="d-grid">

                                <button type="submit" class="btn btn-success">
                                    Accedi
                                </button>

                            </div>

                        </form>

                        <hr>

                        <p class="text-center text-muted mb-0">

                            Non hai ancora un account?

                            <a href="register.php"
                               class="text-success text-decoration-none fw-semibold">
                                Registrati
                            </a>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

<?php include 'footer.php'; ?>
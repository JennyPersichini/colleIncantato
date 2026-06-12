<?php

session_start();
require_once __DIR__ . '/classes/Db.php';

$errors = [];
$success = false;

$name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // input
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // validazione
    if ($name === '') {
        $errors[] = 'Il nome è obbligatorio.';
    }

    if ($email === '') {
        $errors[] = 'L’email è obbligatoria.';
    }

    if (strlen($password) < 8) {
        $errors[] = 'La password deve contenere almeno 8 caratteri.';
    }

    if ($password !== $password_confirm) {
        $errors[] = 'Le password non coincidono.';
    }

    if (empty($errors)) {

        $pdo = Db::connect();

        // controllo email
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);

        if ($stmt->fetch()) {

            $errors[] = 'Questa email è già registrata.';

        } else {

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare('
                INSERT INTO users (name, email, password, role)
                VALUES (:name, :email, :password, :role)
            ');

            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $passwordHash,
                ':role' => 'client'
            ]);

            $success = true;
        }
    }
}

include 'header.php';
?>

<main class="py-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-5">

                <div class="card shadow-lg border-0 rounded-4">

                    <div class="card-body p-5">

                        <h2 class="text-center text-success fw-bold mb-4">
                            Registrati
                        </h2>

                        <?php if ($success): ?>
                            <div class="alert alert-success">
                                Registrazione completata! Ora puoi
                                <a href="login.php" class="alert-link">accedere</a>.
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST">

                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="<?= htmlspecialchars($name) ?>"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       value="<?= htmlspecialchars($email) ?>"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Conferma Password</label>
                                <input type="password"
                                       name="password_confirm"
                                       class="form-control"
                                       required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
                                    Crea account
                                </button>
                            </div>

                        </form>

                        <hr>

                        <p class="text-center text-muted mb-0">
                            Hai già un account?
                            <a href="login.php"
                               class="text-success fw-semibold text-decoration-none">
                                Accedi
                            </a>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

<?php include 'footer.php'; ?>
<?php

// START SESSION SICURO
function startSession(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}


// UTENTE
function currentUser(): ?array
{
    startSession();

    if (empty($_SESSION['user_id'])) {
        return null;
    }

    return [
        'id'    => (int) $_SESSION['user_id'],
        'name'  => $_SESSION['user_name'] ?? '',
        'email' => $_SESSION['user_email'] ?? '',
        'role'  => $_SESSION['user_role'] ?? 'client',
    ];
}


// LOGIN OBBLIGATORIO
function requireLogin(): void
{
    startSession();

    if (empty($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}


// SOLO ADMIN
function requireAdmin(): void
{
    startSession();
    requireLogin();

    if (($_SESSION['user_role'] ?? '') !== 'admin') {
        header('Location: index.php');
        exit;
    }
}


function isAdmin(): bool
{
    startSession();

    return (($_SESSION['user_role'] ?? '') === 'admin');
}


// LOGOUT
function logout(): void
{
    startSession();

    $_SESSION = [];

    if (ini_get('session.use_cookies')) {

        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            time() - 3600,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    session_destroy();

    header('Location: index.php');
    exit;
}
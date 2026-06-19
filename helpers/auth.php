<?php


function startSession(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}


// UTENTE CORRENTE
function currentUser(): ?array
{
    startSession();

    if (!isset($_SESSION['user_id'])) {
        return null;
    }

    return [
        'id'    => $_SESSION['user_id'],
        'name'  => $_SESSION['user_name'] ?? '',
        'email' => $_SESSION['user_email'] ?? '',
        'role'  => $_SESSION['user_role'] ?? 'client',
    ];
}


// LOGIN OBBLIGATORIO
function requireLogin(): void
{
    startSession();

    if (!isset($_SESSION['user_id'])) {

        header('Location: login.php');
        exit;
    }
}


// SOLO ADMIN
function requireAdmin(): void
{
    requireLogin();

    if (($_SESSION['user_role'] ?? '') !== 'admin') {

        header('Location: index.php');
        exit;
    }
}


function isAdmin(): bool
{
    startSession();

    return ($_SESSION['user_role'] ?? '') === 'admin';
}


// LOGOUT
function logout(): void
{
    startSession();

    $_SESSION = [];
    session_destroy();

    header('Location: index.php');
    exit;
}
<?php

function requireLogin(): void 
{
    if(session_status() === PHP_SESSION_NONE){

        session_start();

    }

    if(!isset($_SESSION['user_id'])){

        header('Location: login.php');
        exit;

    }
}

function requireAdmin(): void 
{
    
    requireLogin();

    if(($_SESSION['user_role'] ?? '') !== 'admin'){

        header('Location: index.php');
        exit;

    }
} 

function currentUser(): ?array
{
    if(session_status() === PHP_SESSION_NONE){

        session_start();

    }

    if(!isset($_SESSION['user_id'])){

      return null;

    }

    return [

            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'] ?? '',
            'email' => $_SESSION['user_email'] ?? '',
            'role' => $_SESSION['user_role'] ?? 'client',


    ];

}

function isAdmin(): bool
{
    if (session_status() === PHP_SESSION_NONE) {

        session_start();

    }

    return ($_SESSION['user_role'] ?? '') === 'admin';
}

function logout(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION = [];
    session_destroy();

    header('Location: index.php');
    exit;
}

?>
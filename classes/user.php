<?php

require_once __DIR__ . '/Db.php';

class User
{
    // Ricerca utente tramite ID
    public static function findById(int $id): ?array
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(
            'SELECT id, name, email, role, created_at
             FROM users
             WHERE id = :id'
        );

        $stmt->execute([
            ':id' => $id
        ]);

        $user = $stmt->fetch();

        return $user ?: null;
    }


    // Ricerca utente tramite email
    public static function findByEmail(string $email): ?array
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(
            'SELECT *
             FROM users
             WHERE email = :email'
        );

        $stmt->execute([
            ':email' => $email
        ]);

        $user = $stmt->fetch();

        return $user ?: null;
    }


    // Registrazione utente
    public static function create(
        string $name,
        string $email,
        string $password,
        string $role = 'client'
    ): ?int
    {
        $pdo = Db::connect();

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(
            'INSERT INTO users (name, email, password, role)
             VALUES (:name, :email, :password, :role)'
        );

        $stmt->execute([

            ':name' => $name,
            ':email' => $email,
            ':password' => $passwordHash,
            ':role' => $role

        ]);

        return (int)$pdo->lastInsertId();
    }


    // Tutti gli utenti
    public static function findAll(): array
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(
            'SELECT id, name, email, role, created_at
             FROM users
             ORDER BY created_at DESC'
        );

        return $stmt->fetchAll();
    }


    // Tutti gli amministratori
    public static function findAllAdmins(): array
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(
            "SELECT id, name, email, role
             FROM users
             WHERE role = 'admin'"
        );

        return $stmt->fetchAll();
    }


    // Tutti i clienti
    public static function findAllClients(): array
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(
            "SELECT id, name, email, role
             FROM users
             WHERE role = 'client'"
        );

        return $stmt->fetchAll();
    }


    // Aggiornamento dati utente
    public static function updateUser(
        int $id,
        string $name,
        string $email,
        string $role
    ): bool
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(
            'UPDATE users
             SET name = :name,
                 email = :email,
                 role = :role
             WHERE id = :id'
        );

        return $stmt->execute([

            ':name' => $name,
            ':email' => $email,
            ':role' => $role,
            ':id' => $id

        ]);
    }


    // Cambio password
    public static function updatePassword(
        int $id,
        string $password
    ): bool
    {
        $pdo = Db::connect();

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(
            'UPDATE users
             SET password = :password
             WHERE id = :id'
        );

        return $stmt->execute([

            ':password' => $passwordHash,
            ':id' => $id

        ]);
    }


    // Conta utenti
    public static function countAll(): int
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(
            'SELECT COUNT(*) AS total
             FROM users'
        );

        return (int)$stmt->fetch()['total'];
    }


    // Conta clienti
    public static function countClients(): int
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(
            "SELECT COUNT(*) AS total
             FROM users
             WHERE role = 'client'"
        );

        return (int)$stmt->fetch()['total'];
    }


    // Conta admin
    public static function countAdmins(): int
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(
            "SELECT COUNT(*) AS total
             FROM users
             WHERE role = 'admin'"
        );

        return (int)$stmt->fetch()['total'];
    }


    // Eliminazione utente
    public static function deleteUser(int $id): bool
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(
            'DELETE FROM users
             WHERE id = :id'
        );

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}

?>
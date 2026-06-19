<?php

require_once __DIR__ . '/Db.php';

class Order
{

    // CERCA ORDINE PER ID
    public static function findById(int $id): ?array
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'SELECT *
             FROM orders
             WHERE id = :id'

        );

        $stmt->execute([
            ':id' => $id
        ]);

        $order = $stmt->fetch();

        return $order ?: null;
    }


    // CREA ORDINE
    public static function create(
        int $userId,
        float $total,
        string $status = 'in_attesa'
    ): ?int
    {

        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'INSERT INTO orders
            (user_id, total, status)
            VALUES
            (:user_id, :total, :status)'

        );

        $stmt->execute([

            ':user_id' => $userId,
            ':total' => $total,
            ':status' => $status

        ]);

        return (int)$pdo->lastInsertId();
    }


    // TUTTI GLI ORDINI
    public static function findAll(): array
    {

        $pdo = Db::connect();

        $stmt = $pdo->query(

            'SELECT *
             FROM orders
             ORDER BY created_at DESC'

        );

        return $stmt->fetchAll();
    }


    // ORDINI DI UN UTENTE
    public static function findByUserId(int $userId): array
    {

        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'SELECT *
             FROM orders
             WHERE user_id = :user_id
             ORDER BY created_at DESC'

        );

        $stmt->execute([
            ':user_id' => $userId
        ]);

        return $stmt->fetchAll();
    }


    // AGGIORNA STATO ORDINE
    public static function updateStatus(
        int $id,
        string $status
    ): bool
    {

        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'UPDATE orders
             SET status = :status
             WHERE id = :id'

        );

        return $stmt->execute([

            ':status' => $status,
            ':id' => $id

        ]);
    }


    // CONTA ORDINI
    public static function countAll(): int
    {

        $pdo = Db::connect();

        $stmt = $pdo->query(

            'SELECT COUNT(*) AS total
             FROM orders'

        );

        return (int)$stmt->fetch()['total'];
    }


    // ORDINI IN ATTESA
    public static function countPending(): int
    {

        $pdo = Db::connect();

        $stmt = $pdo->query(

            "SELECT COUNT(*) AS total
             FROM orders
             WHERE status = 'in_attesa'"

        );

        return (int)$stmt->fetch()['total'];
    }


    // ELIMINA ORDINE
    public static function deleteOrder(int $id): bool
    {

        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'DELETE FROM orders
             WHERE id = :id'

        );

        return $stmt->execute([
            ':id' => $id
        ]);
    }

}
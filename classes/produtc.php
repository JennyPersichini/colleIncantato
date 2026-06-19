```php
<?php

require_once __DIR__ . '/Db.php';

class Product
{
    // CERCA PRODOTTO PER ID
    public static function findById(int $id): ?array
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(
            'SELECT
                id,
                name,
                category,
                subCategory,
                quantity,
                disposability,
                stock,
                price,
                image_path
            FROM prodotti
            WHERE id = :id'
        );

        $stmt->execute([
            ':id' => $id
        ]);

        $product = $stmt->fetch();

        return $product ?: null;
    }


    // CREA PRODOTTO
    public static function create(
        string $name,
        string $category,
        string $subCategory,
        float $quantity,
        bool $disposability,
        int $stock,
        float $price,
        ?string $imagePath = null
    ): ?int {

        $pdo = Db::connect();

        $stmt = $pdo->prepare(
            'INSERT INTO prodotti
            (
                name,
                category,
                subCategory,
                quantity,
                disposability,
                stock,
                price,
                image_path
            )
            VALUES
            (
                :name,
                :category,
                :subCategory,
                :quantity,
                :disposability,
                :stock,
                :price,
                :image_path
            )'
        );

        $stmt->execute([
            ':name' => $name,
            ':category' => $category,
            ':subCategory' => $subCategory,
            ':quantity' => $quantity,
            ':disposability' => $disposability,
            ':stock' => $stock,
            ':price' => $price,
            ':image_path' => $imagePath
        ]);

        return (int)$pdo->lastInsertId();
    }


    // TUTTI I PRODOTTI
    public static function findAll(): array
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(
            'SELECT *
            FROM prodotti
            ORDER BY category, name'
        );

        return $stmt->fetchAll();
    }


    // SOLO PRODOTTI DISPONIBILI
    public static function findAllAvailable(): array
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(
            'SELECT *
            FROM prodotti
            WHERE disposability = TRUE
            ORDER BY category, name'
        );

        return $stmt->fetchAll();
    }


    // ATTIVA / DISATTIVA PRODOTTO
    public static function setAvailability(int $id, bool $available): bool
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(
            'UPDATE prodotti
            SET disposability = :available
            WHERE id = :id'
        );

        return $stmt->execute([
            ':available' => $available ? 1 : 0,
            ':id' => $id
        ]);
    }


    // AGGIORNA PRODOTTO
    public static function updateProduct(
        int $id,
        string $name,
        string $category,
        string $subCategory,
        float $quantity,
        bool $disposability,
        int $stock,
        float $price
    ): bool {

        $pdo = Db::connect();

        $stmt = $pdo->prepare(
            'UPDATE prodotti
            SET
                name = :name,
                category = :category,
                subCategory = :subCategory,
                quantity = :quantity,
                disposability = :disposability,
                stock = :stock,
                price = :price
            WHERE id = :id'
        );

        return $stmt->execute([
            ':name' => $name,
            ':category' => $category,
            ':subCategory' => $subCategory,
            ':quantity' => $quantity,
            ':disposability' => $disposability,
            ':stock' => $stock,
            ':price' => $price,
            ':id' => $id
        ]);
    }


    // CONTA PRODOTTI
    public static function countAll(): int
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(
            'SELECT COUNT(*) AS total
            FROM prodotti'
        );

        return (int)$stmt->fetch()['total'];
    }


    // ELIMINA PRODOTTO
    public static function deleteProduct(int $id): bool
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(
            'DELETE FROM prodotti
            WHERE id = :id'
        );

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}


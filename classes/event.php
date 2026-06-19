<?php

require_once __DIR__ . '/Db.php';

class Event
{

    // CERCA EVENTO PER ID
    public static function findById(int $id): ?array
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'SELECT *
             FROM eventi
             WHERE id = :id'

        );

        $stmt->execute([
            ':id' => $id
        ]);

        $event = $stmt->fetch();

        return $event ?: null;
    }


    // CREA EVENTO
    public static function create(
        string $title,
        string $description,
        string $eventDate,
        string $startTime,
        string $endTime,
        int $maxPlaces,
        float $price = 0,
        ?string $imagePath = null
    ): ?int
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'INSERT INTO eventi
            (
                title,
                description,
                event_date,
                start_time,
                end_time,
                max_places,
                available_places,
                price,
                image_path
            )
            VALUES
            (
                :title,
                :description,
                :event_date,
                :start_time,
                :end_time,
                :max_places,
                :available_places,
                :price,
                :image_path
            )'

        );

        $stmt->execute([

            ':title' => $title,
            ':description' => $description,
            ':event_date' => $eventDate,
            ':start_time' => $startTime,
            ':end_time' => $endTime,
            ':max_places' => $maxPlaces,
            ':available_places' => $maxPlaces,
            ':price' => $price,
            ':image_path' => $imagePath

        ]);

        return (int)$pdo->lastInsertId();
    }


    // TUTTI GLI EVENTI
    public static function findAll(): array
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(

            'SELECT *
             FROM eventi
             ORDER BY event_date ASC'

        );

        return $stmt->fetchAll();
    }


    // SOLO EVENTI ATTIVI
    public static function findAllActive(): array
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(

            "SELECT *
             FROM eventi
             WHERE status = 'attivo'
             ORDER BY event_date ASC"

        );

        return $stmt->fetchAll();
    }


    // AGGIORNA EVENTO
    public static function updateEvent(
        int $id,
        string $title,
        string $description,
        string $eventDate,
        string $startTime,
        string $endTime,
        int $maxPlaces,
        float $price
    ): bool
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'UPDATE eventi
             SET title = :title,
                 description = :description,
                 event_date = :event_date,
                 start_time = :start_time,
                 end_time = :end_time,
                 max_places = :max_places,
                 price = :price
             WHERE id = :id'

        );

        return $stmt->execute([

            ':title' => $title,
            ':description' => $description,
            ':event_date' => $eventDate,
            ':start_time' => $startTime,
            ':end_time' => $endTime,
            ':max_places' => $maxPlaces,
            ':price' => $price,
            ':id' => $id

        ]);
    }


    // MODIFICA POSTI DISPONIBILI
    public static function updateAvailablePlaces(
        int $id,
        int $availablePlaces
    ): bool
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'UPDATE eventi
             SET available_places = :available_places
             WHERE id = :id'

        );

        return $stmt->execute([

            ':available_places' => $availablePlaces,
            ':id' => $id

        ]);
    }


    // CAMBIA STATO
    public static function updateStatus(
        int $id,
        string $status
    ): bool
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'UPDATE eventi
             SET status = :status
             WHERE id = :id'

        );

        return $stmt->execute([

            ':status' => $status,
            ':id' => $id

        ]);
    }


    // CONTA EVENTI
    public static function countAll(): int
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(

            'SELECT COUNT(*) AS total
             FROM eventi'

        );

        return (int)$stmt->fetch()['total'];
    }


    // ELIMINA EVENTO
    public static function deleteEvent(int $id): bool
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'DELETE FROM eventi
             WHERE id = :id'

        );

        return $stmt->execute([
            ':id' => $id
        ]);
    }

}
?>
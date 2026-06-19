<?php

require_once __DIR__ . '/Db.php';

class Booking
{

    // CERCA PRENOTAZIONE PER ID
    public static function findById(int $id): ?array
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'SELECT *
             FROM prenotazioni
             WHERE id = :id'

        );

        $stmt->execute([
            ':id' => $id
        ]);

        $booking = $stmt->fetch();

        return $booking ?: null;
    }


    // CREA PRENOTAZIONE
    public static function create(
        string $nome,
        string $email,
        string $dataEvento,
        string $tipo,
        int $numeroPersone,
        string $messaggio = '',
        string $stato = 'in_attesa'
    ): ?int
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'INSERT INTO prenotazioni
            (nome, email, data_evento, tipo, numero_persone, messaggio, stato)
            VALUES
            (:nome, :email, :data_evento, :tipo, :numero_persone, :messaggio, :stato)'

        );

        $stmt->execute([

            ':nome' => $nome,
            ':email' => $email,
            ':data_evento' => $dataEvento,
            ':tipo' => $tipo,
            ':numero_persone' => $numeroPersone,
            ':messaggio' => $messaggio,
            ':stato' => $stato

        ]);

        return (int)$pdo->lastInsertId();
    }


    // TUTTE LE PRENOTAZIONI
    public static function findAll(): array
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(

            'SELECT *
             FROM prenotazioni
             ORDER BY created_at DESC'

        );

        return $stmt->fetchAll();
    }


    // PRENOTAZIONI PER EMAIL
    public static function findByEmail(string $email): array
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'SELECT *
             FROM prenotazioni
             WHERE email = :email
             ORDER BY data_evento DESC'

        );

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetchAll();
    }


    // PRENOTAZIONI PER DATA
    public static function findByDate(string $data): array
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'SELECT *
             FROM prenotazioni
             WHERE data_evento = :data'

        );

        $stmt->execute([
            ':data' => $data
        ]);

        return $stmt->fetchAll();
    }


    // AGGIORNA STATO PRENOTAZIONE
    public static function updateStatus(
        int $id,
        string $stato
    ): bool
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'UPDATE prenotazioni
             SET stato = :stato
             WHERE id = :id'

        );

        return $stmt->execute([

            ':stato' => $stato,
            ':id' => $id

        ]);
    }


    // MODIFICA PRENOTAZIONE
    public static function updateBooking(
        int $id,
        string $nome,
        string $email,
        string $dataEvento,
        string $tipo,
        int $numeroPersone,
        string $messaggio
    ): bool
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'UPDATE prenotazioni
             SET nome = :nome,
                 email = :email,
                 data_evento = :data_evento,
                 tipo = :tipo,
                 numero_persone = :numero_persone,
                 messaggio = :messaggio
             WHERE id = :id'

        );

        return $stmt->execute([

            ':nome' => $nome,
            ':email' => $email,
            ':data_evento' => $dataEvento,
            ':tipo' => $tipo,
            ':numero_persone' => $numeroPersone,
            ':messaggio' => $messaggio,
            ':id' => $id

        ]);
    }


    // CONTA PRENOTAZIONI
    public static function countAll(): int
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(

            'SELECT COUNT(*) AS total
             FROM prenotazioni'

        );

        return (int)$stmt->fetch()['total'];
    }


    // CONTA PRENOTAZIONI IN ATTESA
    public static function countPending(): int
    {
        $pdo = Db::connect();

        $stmt = $pdo->query(

            "SELECT COUNT(*) AS total
             FROM prenotazioni
             WHERE stato = 'in_attesa'"

        );

        return (int)$stmt->fetch()['total'];
    }


    // ELIMINA PRENOTAZIONE
    public static function deleteBooking(int $id): bool
    {
        $pdo = Db::connect();

        $stmt = $pdo->prepare(

            'DELETE FROM prenotazioni
             WHERE id = :id'

        );

        return $stmt->execute([
            ':id' => $id
        ]);
    }

}
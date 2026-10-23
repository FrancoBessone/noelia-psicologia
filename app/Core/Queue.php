<?php
declare(strict_types=1);

namespace App\Core;

/** Cola simple en MySQL. Los trabajos se procesan con el ejecutor de tareas. */
final class Queue
{
    public static function push(array $payload, string $queue = 'default', ?\DateTimeInterface $cuando = null): void
    {
        $disponible = ($cuando ?? new \DateTimeImmutable())->format('Y-m-d H:i:s');
        Database::conectar()
            ->prepare('INSERT INTO jobs (queue, payload, available_at) VALUES (?, ?, ?)')
            ->execute([$queue, json_encode($payload, JSON_UNESCAPED_UNICODE), $disponible]);
    }

    /** Toma hasta $limite trabajos vencidos y los elimina al procesarlos. */
    public static function pop(string $queue = 'default', int $limite = 20): array
    {
        $pdo = Database::conectar();
        $pdo->beginTransaction();
        $stmt = $pdo->prepare(
            'SELECT id, payload FROM jobs WHERE queue = ? AND available_at <= NOW() ORDER BY id LIMIT ' . (int) $limite . ' FOR UPDATE'
        );
        $stmt->execute([$queue]);
        $filas = $stmt->fetchAll();
        foreach ($filas as $fila) {
            $pdo->prepare('DELETE FROM jobs WHERE id = ?')->execute([$fila['id']]);
        }
        $pdo->commit();

        return array_map(fn (array $f) => json_decode($f['payload'], true), $filas);
    }
}

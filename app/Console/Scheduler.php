<?php
declare(strict_types=1);

namespace App\Console;

use App\Core\Database;
use App\Core\Logger;
use Throwable;

/** Ejecuta las tareas registradas y guarda su resultado en scheduler_runs. */
final class Scheduler
{
    /** @var array<string, callable> */
    private array $tareas = [];

    public function registrar(string $nombre, callable $tarea): void
    {
        $this->tareas[$nombre] = $tarea;
    }

    public function ejecutar(?string $soloTarea = null): void
    {
        foreach ($this->tareas as $nombre => $tarea) {
            if ($soloTarea !== null && $soloTarea !== $nombre) {
                continue;
            }
            $this->correr($nombre, $tarea);
        }
    }

    private function correr(string $nombre, callable $tarea): void
    {
        $pdo = Database::conectar();
        try {
            $mensaje = (string) ($tarea() ?? 'ok');
            $estado = 'ok';
        } catch (Throwable $e) {
            $mensaje = $e->getMessage();
            $estado = 'error';
            Logger::error("Tarea {$nombre}: {$mensaje}");
        }
        $pdo->prepare('INSERT INTO scheduler_runs (task, status, message) VALUES (?, ?, ?)')
            ->execute([$nombre, $estado, mb_substr($mensaje, 0, 500)]);
    }
}

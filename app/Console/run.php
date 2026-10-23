<?php
declare(strict_types=1);

/**
 * Uso:
 *   php app/Console/run.php                 -> ejecuta todas las tareas
 *   php app/Console/run.php liberar_senas   -> ejecuta una sola
 */
if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit('Solo desde consola.');
}

spl_autoload_register(function (string $clase): void {
    $prefijo = 'App\\';
    if (strncmp($clase, $prefijo, strlen($prefijo)) !== 0) {
        return;
    }
    $archivo = dirname(__DIR__, 2) . '/app/' . str_replace('\\', '/', substr($clase, strlen($prefijo))) . '.php';
    if (is_file($archivo)) {
        require $archivo;
    }
});

use App\Console\Scheduler;

$scheduler = new Scheduler();
foreach (require __DIR__ . '/tareas.php' as $nombre => $tarea) {
    $scheduler->registrar($nombre, $tarea);
}
$scheduler->ejecutar($argv[1] ?? null);
echo 'Tareas ejecutadas.' . PHP_EOL;

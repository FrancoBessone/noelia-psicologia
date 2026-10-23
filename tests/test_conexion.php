<?php
declare(strict_types=1);

// Ejecutar desde la carpeta del proyecto: php tests/test_conexion.php
require __DIR__ . '/../app/Core/Env.php';
require __DIR__ . '/../app/Core/Database.php';

use App\Core\Database;

try {
    $pdo = Database::conectar();
    $version = $pdo->query('SELECT VERSION() AS v')->fetch();
    echo 'Conexión OK. MySQL ' . $version['v'] . PHP_EOL;

    $existe = $pdo->query("SHOW TABLES LIKE 'users'")->rowCount() > 0;
    echo $existe ? 'Tabla users: OK' . PHP_EOL : 'Falta la tabla users.' . PHP_EOL;
} catch (Throwable $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}

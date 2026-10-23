<?php
declare(strict_types=1);

require __DIR__ . '/../app/Core/Env.php';
require __DIR__ . '/../app/Core/Database.php';

$ok = true;
$revisar = function (string $nombre, bool $cumple, string $detalle = '') use (&$ok): void {
    echo ($cumple ? '[OK]    ' : '[FALLA] ') . $nombre . ($detalle !== '' ? " ({$detalle})" : '') . PHP_EOL;
    $ok = $ok && $cumple;
};

$revisar('PHP 8.2 o superior', version_compare(PHP_VERSION, '8.2.0', '>='), PHP_VERSION);
$revisar('Extensión pdo_mysql', extension_loaded('pdo_mysql'));
$revisar('Extensión json', extension_loaded('json'));
$revisar('Carpeta storage escribible', is_writable(__DIR__ . '/../storage'));

try {
    $pdo = App\Core\Database::conectar();
    $revisar('Conexión a MySQL', true);
    foreach (['users', 'user_emails', 'patient_profiles', 'privacy_consents', 'settings', 'audit_logs', 'jobs', 'scheduler_runs'] as $tabla) {
        $revisar("Tabla {$tabla}", $pdo->query("SHOW TABLES LIKE '{$tabla}'")->rowCount() > 0);
    }
    $n = (int) $pdo->query('SELECT COUNT(*) AS n FROM settings')->fetch()['n'];
    $revisar('Settings iniciales cargados', $n >= 30, "{$n} claves");
} catch (Throwable $e) {
    $revisar('Conexión a MySQL', false, $e->getMessage());
}

echo PHP_EOL . ($ok ? 'Test de humo: TODO OK' : 'Test de humo: hay fallas') . PHP_EOL;

<?php
declare(strict_types=1);

// Ejecutar desde la carpeta del proyecto: php database/seeders/crear_admin.php
// Crea el administrador inicial usando ADMIN_* del archivo .env.
require __DIR__ . '/../../app/Core/Env.php';
require __DIR__ . '/../../app/Core/Database.php';

use App\Core\Database;
use App\Core\Env;

$pdo = Database::conectar(); // también carga el .env

$email = strtolower(trim(Env::get('ADMIN_EMAIL')));
$password = Env::get('ADMIN_PASSWORD');
$nombre = Env::get('ADMIN_NOMBRE', 'Administrador');
$apellido = Env::get('ADMIN_APELLIDO', 'Sistema');

if ($email === '' || strlen($password) < 12) {
    fwrite(STDERR, "Definí ADMIN_EMAIL y ADMIN_PASSWORD (mínimo 12 caracteres) en .env\n");
    exit(1);
}

$consulta = $pdo->prepare('SELECT user_id FROM user_emails WHERE email = ?');
$consulta->execute([$email]);
if ($consulta->fetch()) {
    echo "Ya existe una cuenta con ese correo. No se creó nada.\n";
    exit(0);
}

$pdo->beginTransaction();
try {
    $pdo->prepare(
        'INSERT INTO users (role, nombre, apellido, password_hash, status) VALUES (?, ?, ?, ?, ?)'
    )->execute([
        'administrador',
        $nombre,
        $apellido,
        password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]),
        'activo',
    ]);
    $id = (int) $pdo->lastInsertId();

    $pdo->prepare('INSERT INTO user_emails (user_id, email, label) VALUES (?, ?, ?)')
        ->execute([$id, $email, 'principal']);

    $pdo->commit();
    echo "Administrador creado: {$email}\n";
} catch (Throwable $e) {
    $pdo->rollBack();
    fwrite(STDERR, 'Error: ' . $e->getMessage() . "\n");
    exit(1);
}

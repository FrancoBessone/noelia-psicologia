<?php
declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;
use RuntimeException;

/** Conexión única (singleton) a MySQL usando PDO con consultas preparadas. */
final class Database
{
    private static ?PDO $conexion = null;

    public static function conectar(): PDO
    {
        if (self::$conexion === null) {
            Env::cargar(dirname(__DIR__, 2) . '/.env');

            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                Env::get('DB_HOST', '127.0.0.1'),
                Env::get('DB_PORT', '3306'),
                Env::get('DB_DATABASE')
            );

            try {
                self::$conexion = new PDO(
                    $dsn,
                    Env::get('DB_USERNAME', 'root'),
                    Env::get('DB_PASSWORD', ''),
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (PDOException $e) {
                // No mostramos credenciales ni detalles al usuario.
                throw new RuntimeException('No se pudo conectar a la base de datos.', 0, $e);
            }
        }
        return self::$conexion;
    }
}

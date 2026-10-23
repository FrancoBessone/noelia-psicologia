<?php
declare(strict_types=1);

namespace App\Core;

/** Registra errores y eventos en storage/logs/app.log (nunca datos sensibles). */
final class Logger
{
    public static function info(string $mensaje): void
    {
        self::escribir('INFO', $mensaje);
    }

    public static function error(string $mensaje): void
    {
        self::escribir('ERROR', $mensaje);
    }

    private static function escribir(string $nivel, string $mensaje): void
    {
        $ruta = dirname(__DIR__, 2) . '/storage/logs/app.log';
        $linea = sprintf("[%s] %s %s\n", date('Y-m-d H:i:s'), $nivel, $mensaje);
        file_put_contents($ruta, $linea, FILE_APPEND | LOCK_EX);
    }
}

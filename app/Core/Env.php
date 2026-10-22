<?php
declare(strict_types=1);

namespace App\Core;

/** Lee el archivo .env (que nunca se sube a Git) y expone sus valores. */
final class Env
{
    /** @var array<string, string> */
    private static array $datos = [];

    public static function cargar(string $ruta): void
    {
        if (!is_file($ruta)) {
            return;
        }
        foreach (file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $linea) {
            $linea = trim($linea);
            if ($linea === '' || str_starts_with($linea, '#')) {
                continue;
            }
            [$clave, $valor] = array_map('trim', explode('=', $linea, 2) + [1 => '']);
            self::$datos[$clave] = trim($valor, "\"'");
        }
    }

    public static function get(string $clave, string $porDefecto = ''): string
    {
        return self::$datos[$clave] ?? (getenv($clave) !== false ? (string) getenv($clave) : $porDefecto);
    }
}

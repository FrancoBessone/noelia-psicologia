<?php
declare(strict_types=1);

namespace App\Core;

final class View
{
    /** Renderiza una plantilla y devuelve su HTML como texto. */
    public static function render(string $plantilla, array $datos = []): string
    {
        $archivo = dirname(__DIR__, 2) . '/resources/views/' . $plantilla . '.php';
        extract($datos, EXTR_SKIP);
        ob_start();
        require $archivo;
        return (string) ob_get_clean();
    }
}

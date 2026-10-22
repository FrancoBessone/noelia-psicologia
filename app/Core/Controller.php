<?php
declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    /** Muestra una plantilla dentro del layout común. */
    protected function view(string $plantilla, array $datos = [], string $titulo = 'Lic. Noelia Di Raimondo'): void
    {
        $contenido = View::render($plantilla, $datos);
        echo View::render('layout', ['contenido' => $contenido, 'titulo' => $titulo]);
    }
}

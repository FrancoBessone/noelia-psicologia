<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class PageController extends Controller
{
    public function inicio(): void
    {
        $this->view('inicio', [], 'Inicio · Lic. Noelia Di Raimondo');
    }

    public function sobreMi(): void
    {
        $this->view('sobre_mi', [], 'Sobre mí · Lic. Noelia Di Raimondo');
    }

    public function noEncontrado(): void
    {
        http_response_code(404);
        $this->view('no_encontrado', [], 'Página no encontrada');
    }
}

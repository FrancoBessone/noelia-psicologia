<?php
declare(strict_types=1);

// Autoload simple: App\Clase\Nombre  ->  app/Clase/Nombre.php
spl_autoload_register(function (string $clase): void {
    $prefijo = 'App\\';
    if (strncmp($clase, $prefijo, strlen($prefijo)) !== 0) {
        return;
    }
    $archivo = dirname(__DIR__) . '/app/' . str_replace('\\', '/', substr($clase, strlen($prefijo))) . '.php';
    if (is_file($archivo)) {
        require $archivo;
    }
});

use App\Controllers\PageController;

$pagina = $_GET['p'] ?? 'inicio';
$controlador = new PageController();

match ($pagina) {
    'inicio'   => $controlador->inicio(),
    'sobre-mi' => $controlador->sobreMi(),
    default    => $controlador->noEncontrado(),
};

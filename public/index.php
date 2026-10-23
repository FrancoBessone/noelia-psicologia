<?php
declare(strict_types=1);

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
use App\Core\Logger;
use App\Core\Security;

Security::cabeceras();

ini_set('display_errors', '0');
set_exception_handler(function (Throwable $e): void {
    Logger::error($e->getMessage());
    http_response_code(500);
    echo 'Ocurrió un error. Intentá de nuevo más tarde.';
});

$pagina = $_GET['p'] ?? 'inicio';
$controlador = new PageController();

match ($pagina) {
    'inicio'   => $controlador->inicio(),
    'sobre-mi' => $controlador->sobreMi(),
    default    => $controlador->noEncontrado(),
};

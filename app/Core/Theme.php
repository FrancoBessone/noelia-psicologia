<?php
declare(strict_types=1);

namespace App\Core;

use App\ValueObjects\ColorHex;
use Throwable;

/** Genera las variables CSS de la paleta activa (claves theme_* en settings). */
final class Theme
{
    /** Mapa: clave en settings => variable CSS */
    private const VARIABLES = [
        'theme_bg'        => '--color-fondo',
        'theme_surface'   => '--color-superficie',
        'theme_accent_2'  => '--color-lavanda',
        'theme_border'    => '--color-borde',
        'theme_accent'    => '--color-acento',
        'theme_text'      => '--color-texto',
    ];

    /** Valores de respaldo si la base no responde */
    private const POR_DEFECTO = [
        'theme_bg'       => '#FFF7D3',
        'theme_surface'  => '#E3BBDF',
        'theme_accent_2' => '#F3ABCC',
        'theme_border'   => '#BBC1D0',
        'theme_accent'   => '#874942',
        'theme_text'     => '#2E2A2B',
    ];

    public static function cssRoot(): string
    {
        $valores = self::leerDesdeBase();
        $lineas = [];
        foreach (self::VARIABLES as $clave => $variable) {
            $hex = $valores[$clave] ?? self::POR_DEFECTO[$clave];
            try {
                $lineas[] = $variable . ': ' . (new ColorHex($hex))->valor() . ';';
            } catch (Throwable) {
                $lineas[] = $variable . ': ' . self::POR_DEFECTO[$clave] . ';';
            }
        }
        return ':root { ' . implode(' ', $lineas) . ' }';
    }

    /** @return array<string, string> */
    private static function leerDesdeBase(): array
    {
        try {
            $pdo = Database::conectar();
            $consulta = $pdo->query("SELECT `key`, value FROM settings WHERE `key` LIKE 'theme_%' AND `key` NOT LIKE 'theme_default_%'");
            $salida = [];
            foreach ($consulta->fetchAll() as $fila) {
                $salida[$fila['key']] = $fila['value'];
            }
            return $salida;
        } catch (Throwable) {
            return [];
        }
    }
}

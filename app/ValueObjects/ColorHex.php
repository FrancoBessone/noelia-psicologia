<?php
declare(strict_types=1);

namespace App\ValueObjects;

use InvalidArgumentException;

/** Color en formato #RRGGBB. Se valida al construirlo. */
final class ColorHex
{
    private string $valor;

    public function __construct(string $hex)
    {
        $hex = strtoupper(trim($hex));
        if (preg_match('/^#[0-9A-F]{6}$/', $hex) !== 1) {
            throw new InvalidArgumentException("Color HEX inválido: {$hex}");
        }
        $this->valor = $hex;
    }

    public function valor(): string
    {
        return $this->valor;
    }
}

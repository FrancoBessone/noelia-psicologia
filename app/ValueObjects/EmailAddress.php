<?php
declare(strict_types=1);

namespace App\ValueObjects;

use InvalidArgumentException;

final class EmailAddress
{
    private string $valor;

    public function __construct(string $email)
    {
        $email = strtolower(trim($email));
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException("Correo inválido: {$email}");
        }
        $this->valor = $email;
    }

    public function valor(): string
    {
        return $this->valor;
    }

    public function __toString(): string
    {
        return $this->valor;
    }
}

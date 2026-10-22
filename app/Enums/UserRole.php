<?php
declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case Paciente = 'paciente';
    case Dueno = 'dueno';
    case Administrador = 'administrador';

    public function etiqueta(): string
    {
        return match ($this) {
            self::Paciente => 'Paciente',
            self::Dueno => 'Dueña',
            self::Administrador => 'Administrador',
        };
    }
}

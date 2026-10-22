<?php
declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRole;

final class Patient extends User
{
    public function rol(): UserRole
    {
        return UserRole::Paciente;
    }

    public function maxCorreos(): int
    {
        return 1;
    }
}

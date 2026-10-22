<?php
declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRole;

final class Administrator extends User
{
    public function rol(): UserRole
    {
        return UserRole::Administrador;
    }

    public function maxCorreos(): int
    {
        return 2;
    }
}

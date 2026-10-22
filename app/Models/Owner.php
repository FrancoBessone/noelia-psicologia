<?php
declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRole;

final class Owner extends User
{
    public function rol(): UserRole
    {
        return UserRole::Dueno;
    }

    public function maxCorreos(): int
    {
        return 2;
    }
}

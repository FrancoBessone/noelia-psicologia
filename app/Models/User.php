<?php
declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRole;
use App\ValueObjects\EmailAddress;
use DomainException;

abstract class User
{
    /** @var EmailAddress[] */
    protected array $correos = [];

    public function __construct(
        protected string $nombre,
        protected string $apellido,
    ) {
    }


cd /c/xampp/htdocs/noelia-psicologia
git init -b main
git add .
git commit -m "chore: base del proyecto (inicio, sobre mí, modelos OOP)"
git remote add origin https://github.com/TU_USUARIO/noelia-psicologia.git
git push -u origin main

[200~cd /c/xampp/htdocs/noelia-psicologia
git init -b main
git add .
git commit -m "chore: base del proyecto (inicio, sobre mí, modelos OOP)"
git remote add origin https://github.com/TU_USUARIO/noelia-psicologia.git
git push -u origin main
cd /c/xampp/htdocs/noelia-psicologia
git switch develop
git pull
git switch -c feature/conexion-mysql

/c/xampp/mysql/bin/mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS noelia_psicologia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

cd /c/xampp/htdocs/noelia-psicologia
mkdir -p config database/schema tests

cat > .env.example <<'EOF'
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=noelia_psicologia
DB_USERNAME=root
DB_PASSWORD=

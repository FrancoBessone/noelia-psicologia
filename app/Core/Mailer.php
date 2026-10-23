<?php
declare(strict_types=1);

namespace App\Core;

/**
 * En desarrollo (MAIL_DRIVER=log) guarda cada correo en storage/mail/
 * en lugar de enviarlo. El proveedor real se configura más adelante.
 */
final class Mailer
{
    public function enviar(string $para, string $asunto, string $cuerpo): void
    {
        $driver = Env::get('MAIL_DRIVER', 'log');

        if ($driver === 'log') {
            $nombre = date('Ymd_His') . '_' . bin2hex(random_bytes(3)) . '.txt';
            $contenido = "Para: {$para}\nAsunto: {$asunto}\n\n{$cuerpo}\n";
            file_put_contents(dirname(__DIR__, 2) . '/storage/mail/' . $nombre, $contenido);
            Logger::info("Correo simulado a {$para}: {$asunto}");
            return;
        }

        throw new \RuntimeException("Driver de correo no implementado: {$driver}");
    }
}

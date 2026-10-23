<?php
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="<?= $base ?>/assets/css/tema.css">
    <style><?= \App\Core\Theme::cssRoot() ?></style>
    <link rel="stylesheet" href="<?= $base ?>/assets/css/app.css">
</head>
<body>
<header class="encabezado">
    <div class="contenedor fila">
        <strong class="logo">Lic. Noelia Di Raimondo · Mat. 6207</strong>
        <nav>
            <a href="<?= $base ?>/index.php?p=inicio">Inicio</a>
            <a href="<?= $base ?>/index.php?p=sobre-mi">Sobre mí</a>
        </nav>
    </div>
</header>
<main class="contenedor">
    <?= $contenido ?>
</main>
<footer class="pie">
    <div class="contenedor">© 2026 Lic. Noelia Di Raimondo · Matrícula 6207</div>
</footer>
</body>
</html>

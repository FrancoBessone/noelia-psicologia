# Noelia Di Raimondo · Sitio y turnero

Base del proyecto (savepoint inicial).

## Cómo correrlo en XAMPP
1. Copiar esta carpeta en `C:\xampp\htdocs\noelia-psicologia`.
2. Iniciar Apache desde el panel de XAMPP.
3. Abrir `http://localhost/noelia-psicologia/public/`.

## Estructura
- `public/`: único punto de entrada web (index.php y assets).
- `app/Core/`: clases base (Controller, View).
- `app/Controllers/`: controladores finos.
- `app/Models/`: usuarios (User abstracta y subclases por rol).
- `app/Enums/`: enumeraciones (roles).
- `app/ValueObjects/`: valores validados (correo).
- `resources/views/`: plantillas HTML con PHP.

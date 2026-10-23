CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role ENUM('paciente','dueno','administrador') NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NULL,
    status ENUM('activo','inactivo','pendiente_activacion') NOT NULL DEFAULT 'activo',
    two_factor_enabled TINYINT(1) NOT NULL DEFAULT 0,
    name_changed_at DATETIME NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS user_emails (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    email VARCHAR(190) NOT NULL,
    label ENUM('unico','personal','trabajo','principal','seguridad') NOT NULL,
    verified_at DATETIME NULL,
    UNIQUE KEY uq_user_emails_email (email),
    KEY idx_user_emails_user (user_id),
    CONSTRAINT fk_user_emails_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

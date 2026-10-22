CREATE TABLE IF NOT EXISTS patient_profiles (
    user_id BIGINT UNSIGNED NOT NULL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    celular VARCHAR(30) NOT NULL,
    contacto_emergencia VARCHAR(150) NOT NULL,
    frecuencia ENUM('semanal','quincenal') NOT NULL DEFAULT 'semanal',
    name_changed_at DATETIME NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_patient_profiles_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Solo se inserta. Nunca se actualiza ni se borra (prueba de aceptación).
CREATE TABLE IF NOT EXISTS privacy_consents (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    text_version VARCHAR(20) NOT NULL,
    accepted_at DATETIME NOT NULL,
    ip VARCHAR(45) NOT NULL,
    KEY idx_privacy_consents_user (user_id),
    CONSTRAINT fk_privacy_consents_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

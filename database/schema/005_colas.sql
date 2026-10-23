CREATE TABLE IF NOT EXISTS jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    queue VARCHAR(50) NOT NULL DEFAULT 'default',
    payload JSON NOT NULL,
    attempts TINYINT UNSIGNED NOT NULL DEFAULT 0,
    available_at DATETIME NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_jobs_queue (queue, available_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS scheduler_runs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(80) NOT NULL,
    status ENUM('ok','error') NOT NULL,
    message VARCHAR(500) NULL,
    ran_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_scheduler_task (task, ran_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

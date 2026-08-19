CREATE DATABASE IF NOT EXISTS pagina_web_db;
USE pagina_web_db;

CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ultimo_acceso TIMESTAMP NULL
);

-- Crear usuario específico para la aplicación (NO usar root)
CREATE USER 'adminvet'@'bvc.com' IDENTIFIED BY 'Ban692851bh';
GRANT SELECT, INSERT, UPDATE, DELETE ON pagina_web_db.* TO 'adminvet'@'localhost';
FLUSH PRIVILEGES;
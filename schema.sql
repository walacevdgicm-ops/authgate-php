-- AuthGate PHP: estrutura do banco MySQL
CREATE DATABASE IF NOT EXISTS db_e6207b5d1c37 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_e6207b5d1c37;

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario      INT AUTO_INCREMENT PRIMARY KEY,
    campo_nome      VARCHAR(150) NOT NULL,
    campo_email     VARCHAR(150) NOT NULL UNIQUE,
    campo_senha     VARCHAR(255) NOT NULL,          -- hash gerado por password_hash()
    campo_cpf       CHAR(11)     NOT NULL UNIQUE,
    data_nascimento DATE         NOT NULL,
    criado_em       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tb_sessoes (
    id_sessao  INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    criado_em  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

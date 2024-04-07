CREATE DATABASE IF NOT EXISTS db_todolist;

USE db_todolist;

CREATE TABLE IF NOT EXISTS task(
id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
name        VARCHAR(50) NOT NULL,
description VARCHAR(100),
limitDate   time,
priority    INT(5),
CONSTRAINT pk_task PRIMARY KEY(id)
)ENGINE=InnoDb DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

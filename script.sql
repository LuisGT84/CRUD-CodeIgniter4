-- CREACIÓN DE BASE DE DATOS
CREATE DATABASE IF NOT EXISTS umg2
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE umg2;

-- TABLA ALUMNOS
DROP TABLE IF EXISTS alumnos;
CREATE TABLE alumnos (
  alumno INT(11) NOT NULL AUTO_INCREMENT,      -- PK alumno
  nombre VARCHAR(100) DEFAULT NULL,            -- Nombre
  apellido VARCHAR(100) DEFAULT NULL,          -- Apellido
  direccion VARCHAR(100) DEFAULT NULL,         -- Dirección
  movil VARCHAR(100) DEFAULT NULL,             -- Teléfono móvil
  email VARCHAR(100) DEFAULT NULL,             -- Correo
  fecha_creacion VARCHAR(100) DEFAULT NULL,    -- Fecha de alta
  user VARCHAR(100) DEFAULT NULL,              -- Usuario creador
  inactivo INT(11) NOT NULL DEFAULT 0,         -- 0=activo, 1=inactivo
  PRIMARY KEY (alumno)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- TABLA CURSOS
DROP TABLE IF EXISTS cursos;

CREATE TABLE cursos (
  curso INT(11) NOT NULL AUTO_INCREMENT,       -- PK curso
  nombre VARCHAR(100) DEFAULT NULL,            -- Nombre del curso
  profesor VARCHAR(100) DEFAULT NULL,          -- Nombre del profesor
  inactivo INT(11) NOT NULL DEFAULT 0,         -- 0=activo, 1=inactivo
  PRIMARY KEY (curso)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- TABLA DETALLE_ALUMNO_CURSO (relación N:N)
DROP TABLE IF EXISTS detalle_alumno_curso;

CREATE TABLE detalle_alumno_curso (
  id INT AUTO_INCREMENT PRIMARY KEY,           -- PK del detalle
  alumno INT NOT NULL,                         -- FK a alumnos.alumno
  curso  INT NOT NULL,                         -- FK a cursos.curso
  UNIQUE KEY uq_alumno_curso (alumno, curso),  -- Evita duplicados
  CONSTRAINT fk_detalle_alumno FOREIGN KEY (alumno)
    REFERENCES alumnos(alumno) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_detalle_curso FOREIGN KEY (curso)
    REFERENCES cursos(curso) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- DATOS DE PRUEBA 
INSERT INTO alumnos (nombre, apellido, direccion, movil, email, fecha_creacion, user, inactivo)
VALUES 
('Juan', 'Pérez', 'Zona 1', '5555-1234', 'juan@example.com', '2025-08-29', 'admin', 0),
('María', 'López', 'Zona 5', '5555-5678', 'maria@example.com', '2025-08-29', 'admin', 0);

INSERT INTO cursos (nombre, profesor, inactivo)
VALUES 
('Matemáticas', 'Profesor García', 0),
('Historia', 'Profesor Ramírez', 0),
('Computación', 'Profesor López', 1);

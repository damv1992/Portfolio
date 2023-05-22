CREATE DATABASE Portfolio COLLATE 'utf8mb4_general_ci';

-- CREACIÓN DE TABLAS
CREATE TABLE Configuracion (
    Nombre varchar(50) NOT NULL,
    Profesiones varchar(50) NOT NULL,
    Icono varchar(50) NOT NULL,
    Fondo varchar(50) NOT NULL,
    Correo varchar(50) NOT NULL,
    Direccion varchar(50),
    Telefono int NOT NULL,
    Usuario varchar(50) NOT NULL,
    Contraseña char(60) NOT NULL
);
CREATE TABLE Sociales (
    IdRedSocial bigint NOT NULL,
    Icono varchar(25),
    Enlace varchar(50),
    PRIMARY KEY (IdRedSocial)
);
CREATE TABLE Acerca (
    Frase varchar(500),
    Titulo varchar(50) NOT NULL,
    Descripcion mediumtext NOT NULL,
    Cumpleaños date NOT NULL,
    Ciudad varchar(50) NOT NULL,
    Grado varchar(50) NOT NULL,
    Matricula int,
    Freelance boolean NOT NULL,
    Foto varchar(50) NOT NULL
);
CREATE TABLE Visitantes (
    Ip varchar(20) NOT NULL,
    Perteneciente varchar(100),
    FechaVisita datetime NOT NULL,
    PRIMARY KEY (Ip)
);
CREATE TABLE Habilidades (
    IdHabilidad bigint NOT NULL,
    Habilidad varchar(50) NOT NULL,
    Porcentaje int NOT NULL,
    PRIMARY KEY (IdHabilidad)
);
CREATE TABLE Experiencias (
    IdExperiencia bigint NOT NULL,
    Cargo varchar(100) NOT NULL,
    FechaInicio date NOT NULL,
    FechaFin date,
    Presente boolean NOT NULL,
    Empresa varchar(100) NOT NULL,
    Ciudad varchar(50) NOT NULL,
    Funciones mediumtext NOT NULL,
    PRIMARY KEY (IdExperiencia)
);
CREATE TABLE Educaciones (
    IdEducacion bigint NOT NULL,
    Educacion varchar(100) NOT NULL,
    FechaInicio date NOT NULL,
    FechaFin date,
    Presente boolean NOT NULL,
    Institucion varchar(100) NOT NULL,
    Ciudad varchar(50) NOT NULL,
    PRIMARY KEY (IdEducacion)
);
CREATE TABLE Cursos (
    IdCurso bigint NOT NULL,
    Curso varchar(100) NOT NULL,
    Institucion varchar(100) NOT NULL,
    FechaInicio date NOT NULL,
    FechaFin date,
    Presente boolean NOT NULL,
    PRIMARY KEY (IdCurso)
);
CREATE TABLE Proyectos (
    IdProyecto bigint NOT NULL,
    Titulo varchar(50) NOT NULL,
    Categoria varchar(50) NOT NULL,
    Cliente varchar(50) NOT NULL,
    Enlace varchar(50) NOT NULL,
    Fecha date NOT NULL,
    Descripcion mediumtext NOT NULL,
    PRIMARY KEY (IdProyecto)
);
CREATE TABLE Capturas (
    IdCaptura bigint NOT NULL,
    Captura varchar(50) NOT NULL,
    Proyecto bigint NOT NULL,
    PRIMARY KEY (IdCaptura),
    FOREIGN KEY (Proyecto) REFERENCES Proyectos(IdProyecto)
);

-- LIMPIADO DE BASE DE DATOS
DELETE FROM Capturas;
DELETE FROM Proyectos;
DELETE FROM Cursos;
DELETE FROM Educaciones;
DELETE FROM Experiencias;
DELETE FROM Habilidades;
DELETE FROM Acerca;
DELETE FROM Sociales;
DELETE FROM Configuracion;
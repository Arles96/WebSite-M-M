CREATE DATABASE WebSite;

CREATE TABLE Administrador (
  correo VARCHAR(80) PRIMARY KEY,
  contrasenia VARCHAR(70)
);

CREATE TABLE Publicidad (
  codigo INT PRIMARY KEY,
  nombre VARCHAR(80),
  tipo VARCHAR(40),
  descripcion TEXT,
  precio FLOAT,
  imagen VARCHAR(255)
);

CREATE TABLE Cliente (
  numero_cliente INT AUTO_INCREMENT PRIMARY KEY,
  fecha DATE,
  nombre VARCHAR(100),
  mensaje TEXT,
  correo VARCHAR(100),
  telefono VARCHAR(18)
);

CREATE TABLE Bitacora (
  num_bitacora INT AUTO_INCREMENT PRIMARY KEY,
  correo_adm VARCHAR(100),
  descripcion TEXT,
  fecha DATE,
  FOREIGN KEY (correo_adm) REFERENCES Administrador(correo)
);

CREATE TABLE Crud (
  num_crud INT AUTO_INCREMENT PRIMARY KEY,
  codigoPublicidad INT,
  correo VARCHAR(80),
  FOREIGN KEY (codigoPublicidad) REFERENCES Publicidad(codigo),
  FOREIGN KEY (correo) REFERENCES Administrador(correo)
);

CREATE TABLE Ediciones (
  num_ediciones INT AUTO_INCREMENT PRIMARY KEY,
  numero_cliente INT,
  correo VARCHAR(80),
  FOREIGN KEY (numero_cliente) REFERENCES Cliente(numero_cliente),
  FOREIGN KEY (correo) REFERENCES Administrador(correo)
);

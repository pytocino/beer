-- Crear la base de datos
CREATE DATABASE beerfinder;
USE beerfinder;
-- Crear la tabla de Marcas de Cerveza
CREATE TABLE marcas_cerveza (
    id_marca INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

-- Crear la tabla de locales
CREATE TABLE locales (
    id_local INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion TEXT,
    latitud DECIMAL(10, 6),
    longitud DECIMAL(10, 6),
    tipo_local VARCHAR(255)
);

-- Crear la tabla de Relación entre Marcas de Cerveza y locales
CREATE TABLE marcas_locales (
    id_marcas_locales INT AUTO_INCREMENT PRIMARY KEY,
    id_local INT,
    nombre_marca VARCHAR(255),
    FOREIGN KEY (id_local) REFERENCES locales(id_local)
);

-- Modificación del procedimiento para utilizar las columnas existentes en marcas_locales
CREATE PROCEDURE AgregarMarcaLocal(
    IN nombre_local VARCHAR(255),
    IN nombre_marca VARCHAR(255)
)
BEGIN
    DECLARE local_id INT;
    DECLARE marca_id INT;

    -- Buscar el ID del local por su nombre
    SELECT id_local INTO local_id FROM locales WHERE nombre = nombre_local;

    IF local_id IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El local no existe.';
    END IF;

    -- Buscar el ID de la marca por su nombre
    SELECT id_marca INTO marca_id FROM marcas_cerveza WHERE nombre = nombre_marca;

    IF marca_id IS NULL THEN
        INSERT INTO marcas_cerveza (nombre) VALUES (nombre_marca);
        SET marca_id = LAST_INSERT_ID();
    END IF;

    -- Verificar si ya existe la relación entre la marca y el local
    IF EXISTS(SELECT 1 FROM marcas_locales WHERE id_local = local_id AND nombre_marca = nombre_marca) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La relación entre esta marca y local ya existe.';
    ELSE
        -- Agregar la relación entre la marca y el local
        INSERT INTO marcas_locales (id_local, nombre_marca) VALUES (local_id, nombre_marca);
    END IF;
END;


SELECT L.*
FROM locales L
JOIN marcas_locales ML ON L.id_local = ML.id_local
WHERE ML.nombre_marca = '?';

CALL AgregarMarcaLocal('Dower''s', 'aguila');
CALL AgregarMarcaLocal('Dower''s', 'heineken');
CALL AgregarMarcaLocal('Dower''s', 'amstel');
CALL AgregarMarcaLocal('CID Cafetería', 'estrella galicia');
CALL AgregarMarcaLocal('CID Cafetería', 'mahou');
CALL AgregarMarcaLocal('Radio Bar', 'guinness');
CALL AgregarMarcaLocal('Radio Bar', 'estrella galicia');

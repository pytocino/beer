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

DELIMITER //

CREATE PROCEDURE AgregarAsociacionMarcaLocal(
    IN nombre_marca VARCHAR(255),
    IN nombre_local VARCHAR(255)
)
BEGIN
    DECLARE local_id INT;
    DECLARE marca_existente INT;
    
    -- Obtener el ID del local si existe
    SELECT id_local INTO local_id
    FROM locales
    WHERE nombre = nombre_local;
    
    -- Verificar si el local existe
    IF local_id IS NOT NULL THEN
        -- Verificar si la asociación ya existe
        SELECT COUNT(*)
        INTO marca_existente
        FROM marcas_locales
        WHERE id_local = local_id AND nombre_marca = nombre_marca;
        
        -- Insertar la asociación si no existe
        IF marca_existente = 0 THEN
            INSERT INTO marcas_locales (id_local, nombre_marca)
            VALUES (local_id, nombre_marca);
        ELSE
            SELECT 'La asociación ya existe. No se insertó ningún registro.' AS mensaje;
        END IF;
    ELSE
        SELECT 'El local especificado no se encuentra en la base de datos.' AS mensaje;
    END IF;
END //

DELIMITER ;


INSERT INTO `locales` (`nombre`, `direccion`, `latitud`, `longitud`, `tipo_local`) VALUES
('Dower''s', 'https://maps.app.goo.gl/3RAkPGM2kQW9cWsR7', '37.606043', '-0.981566', 'bar'),
('CID Cafeteria', 'https://maps.app.goo.gl/MK39qfCeBTHtSkPz9', '37.606218', '-0.982990', 'bar/cafeteria'),
('Radio Bar', 'https://maps.app.goo.gl/mWyKsQ1Am5HvrU6r5', '37.599912', '-0.986942', 'pub');


SELECT L.*
FROM locales L
JOIN marcas_locales ML ON L.id_local = ML.id_local
WHERE ML.nombre_marca = '?';

CALL AgregarAsociacionMarcaLocal('aguila', 'Dower''s');
CALL AgregarAsociacionMarcaLocal('heineken', 'Dower''s');
CALL AgregarAsociacionMarcaLocal('amstel', 'Dower''s');
CALL AgregarAsociacionMarcaLocal('estrella galicia', 'CID Cafeteria');
CALL AgregarAsociacionMarcaLocal('mahou', 'CID Cafeteria');
CALL AgregarAsociacionMarcaLocal('guinnes', 'Radio Bar');
CALL AgregarAsociacionMarcaLocal('estrella galicia', 'Radio Bar');

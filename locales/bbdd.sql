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

CREATE PROCEDURE AsociarMarcaConLocal(
    IN nombreLocal VARCHAR(255),
    IN nombreMarca VARCHAR(255)
)
BEGIN
    DECLARE localID INT;
    DECLARE marcaID INT;
    
    -- Obtener el ID del local
    SELECT id_local INTO localID FROM locales WHERE nombre = nombreLocal;
    
    -- Obtener el ID de la marca
    SELECT id_marca INTO marcaID FROM marcas_cerveza WHERE nombre = nombreMarca;
    
    -- Verificar si la relación ya existe
    IF localID IS NOT NULL AND marcaID IS NOT NULL THEN
        DECLARE existeRelacion INT;
        SELECT COUNT(*) INTO existeRelacion 
        FROM marcas_locales 
        WHERE id_local = localID AND nombre_marca = nombreMarca;
        
        IF existeRelacion = 0 THEN
            -- Insertar la relación si no existe
            INSERT INTO marcas_locales (id_local, nombre_marca)
            VALUES (localID, nombreMarca);
            SELECT 'Relación insertada correctamente' AS Message;
        ELSE
            SELECT 'La relación ya existe' AS Message;
        END IF;
    ELSE
        SELECT 'Error: Local o marca no encontrados' AS Message;
    END IF;
    
END //

DELIMITER ;



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

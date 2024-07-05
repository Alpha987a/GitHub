-- Crear base de datos
CREATE DATABASE tienda;

-- Usar la base de datos
USE tienda;

-- Crear tabla de productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL
);

-- Crear tabla de tickets
CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear tabla de detalle de tickets
CREATE TABLE ticket_detalles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT,
    producto_id INT,
    cantidad INT,
    total DECIMAL(10, 2),
    FOREIGN KEY (ticket_id) REFERENCES tickets(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Insertar productos iniciales
INSERT INTO productos (nombre, precio, stock) VALUES 
('Producto A', 10.00, 10),
('Producto B', 20.00, 5),
('Producto C', 30.00, 2);

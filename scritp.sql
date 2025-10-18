CREATE DATABASE crud_cuadrado CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE crud_cuadrado;

CREATE TABLE cuadrado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lado DECIMAL(10,2) NOT NULL,
    area DECIMAL(10,2) NOT NULL,
    perimetro DECIMAL(10,2) NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO cuadrado (lado, area, perimetro,fecha) 
VALUES (5, 25, 20, default);

SELECT * FROM cuadrado;
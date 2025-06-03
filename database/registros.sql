CREATE DATABASE Inventario;

use Inventario;
INSERT INTO Persona (apellidos, nombres, tipoDoc, nroDocumento, telefono, email, direccion) VALUES
('Gonzalez', 'Maria Fernanda', 'DNI', '12345678', '987654321', 'maria.gonzalez@email.com', 'Av. Siempre Viva 123'),
('Lopez', 'Juan Carlos', 'DNI', '87654321', '987654322', 'juan.lopez@email.com', 'Calle Falsa 456'),
('Ramirez', 'Ana Lucia', 'Pasaporte', 'X1234567', '987654323', 'ana.ramirez@email.com', 'Jr. Los Pinos 789'),
('Torres', 'Pedro Luis', 'DNI', '23456789', '987654324', 'pedro.torres@email.com', 'Av. Central 101'),
('Martinez', 'Sofia Isabel', 'DNI', '34567890', '987654325', 'sofia.martinez@email.com', 'Jr. Las Flores 202'),
('Diaz', 'Carlos Alberto', 'DNI', '45678901', '987654326', 'carlos.diaz@email.com', 'Av. Los Andes 303'),
('Mendoza', 'Laura Elena', 'DNI', '56789012', '987654327', 'laura.mendoza@email.com', 'Calle Real 404'),
('Vargas', 'Miguel Angel', 'Pasaporte', 'P9876543', '987654328', 'miguel.vargas@email.com', 'Av. Libertad 505'),
('Castillo', 'Elena Patricia', 'DNI', '67890123', '987654329', 'elena.castillo@email.com', 'Jr. Los Sauces 606'),
('Rojas', 'Diego Armando', 'DNI', '78901234', '987654330', 'diego.rojas@email.com', 'Calle Las Palmas 707');
INSERT INTO AREAS (area) VALUES
('Administracion'),
('Ventas'),
('Tecnologia'),
('Recursos Humanos'),
('Finanzas'),
('Logistica'),
('Marketing'),
('Produccion'),
('Atencion al Cliente'),
('Legal');
INSERT INTO ROLES (rol) VALUES
('Gerente'),
('Analista'),
('Asistente'),
('Supervisor'),
('Director'),
('Tecnico'),
('Contador'),
('Secretario'),
('Jefe de Proyecto'),
('Auxiliar');
INSERT INTO COLABORADORES (inicio, fin, idPersona, idArea, idRol) VALUES
('2023-01-01', NULL, 1, 1, 1),
('2022-05-15', '2024-05-15', 2, 2, 2),
('2021-09-20', NULL, 3, 3, 3),
('2024-03-10', NULL, 4, 4, 4),
('2023-06-01', '2025-06-01', 5, 5, 5),
('2022-11-30', NULL, 6, 6, 6),
('2023-08-21', NULL, 7, 7, 7),
('2024-01-10', NULL, 8, 8, 8),
('2023-04-05', '2024-12-31', 9, 9, 9),
('2022-07-17', NULL, 10, 10, 10);
INSERT INTO USUARIOS (nomUser, passUser, estado, idColaborador) VALUES
('mariaf', 'pass123', 'Activo', 1),
('juanc', 'juansPass', 'Inactivo', 2),
('anarl', 'anaPwd', 'Activo', 3),
('pedrot', 'pedroPwd', 'Activo', 4),
('sofim', 'sofiPass', 'Activo', 5),
('carlod', 'carlPass', 'Activo', 6),
('lauram', 'laura123', 'Inactivo', 7),
('miguelv', 'miguelPwd', 'Activo', 8),
('elenac', 'elenPass', 'Activo', 9),
('diegor', 'diegPass', 'Activo', 10);
INSERT INTO CATEGORIAS (categoria) VALUES
('Computo'),
('Muebles'),
('Electronica'),
('Vehiculos'),
('Herramientas'),
('Software'),
('Papeleria'),
('Electrodomesticos'),
('Telefonia'),
('Seguridad');
INSERT INTO SUBCATEGORIAS (subCategoria, idCategoria) VALUES
('Laptop', 1),
('Escritorio', 2),
('Monitor', 1),
('Sillas', 2),
('Smartphone', 9),
('Impresora', 1),
('Software Antivirus', 6),
('Tablet', 1),
('Proyector', 3),
('Cajonera', 2);
INSERT INTO MARCAS (marca, idSubCategoria) VALUES
('HP', 1),
('Lenovo', 1),
('Samsung', 5),
('Dell', 3),
('Apple', 8),
('Brother', 6),
('Asus', 1),
('Epson', 6),
('Sony', 9),
('Ikea', 2);
INSERT INTO BIENES (condicion, modelo, numSerie, descripcion, fotografia, idMarca, idUsuario) VALUES
('Nuevo', 'Pavilion 15', 'SN123456', 'Laptop HP Pavilion 15 pulgadas', NULL, 1, 1),
('Usado', 'ThinkPad X1', 'SN234567', 'Laptop Lenovo ThinkPad X1 Carbon', NULL, 2, 3),
('Nuevo', 'Galaxy S21', 'SN345678', 'Smartphone Samsung Galaxy S21', NULL, 3, 8),
('Reparado', 'UltraSharp U2719D', 'SN456789', 'Monitor Dell UltraSharp 27 pulgadas', NULL, 4, 4),
('Nuevo', 'iPad Air', 'SN567890', 'Tablet Apple iPad Air 10.9"', NULL, 5, 5),
('Nuevo', 'HL-L2350DW', 'SN678901', 'Impresora Brother HL-L2350DW', NULL, 6, 6),
('Nuevo', 'ROG Zephyrus', 'SN789012', 'Laptop Asus ROG Zephyrus Gaming', NULL, 7, 7),
('Usado', 'WorkForce WF-2850', 'SN890123', 'Impresora Epson WorkForce WF-2850', NULL, 8, 2),
('Nuevo', 'VPL-VW295ES', 'SN901234', 'Proyector Sony 4K HDR', NULL, 9, 9),
('Nuevo', 'Malm', 'SN012345', 'Escritorio Ikea Malm madera clara', NULL, 10, 10);
INSERT INTO ASIGNACIONES (inicio, fin, idBien, idColaborador) VALUES
('2023-01-10', NULL, 1, 1),
('2023-05-15', '2024-05-15', 2, 2),
('2023-02-20', NULL, 3, 3),
('2024-03-12', NULL, 4, 4),
('2023-06-05', NULL, 5, 5),
('2022-12-01', NULL, 6, 6),
('2023-09-21', NULL, 7, 7),
('2024-01-15', NULL, 8, 8),
('2023-04-07', '2024-12-31', 9, 9),
('2022-07-18', NULL, 10, 10);

INSERT INTO CARACTERISTICAS (segmento, idBien) VALUES
('Procesador Intel i7 10ma gen', 1),
('Pantalla 15.6" Full HD', 1),
('Memoria RAM 16GB', 2),
('Disco SSD 512GB', 2),
('Batería 4000mAh', 3),
('Resolución 3840x2160', 4),
('Sistema operativo Windows 10', 5),
('Impresión inalámbrica', 6),
('Tarjeta gráfica NVIDIA RTX 3060', 7),
('Pantalla táctil', 8);
INSERT INTO CONFIGURACIONES (configuracion, idCategoria) VALUES
('Configuración de pantalla', 1),
('Configuración de red', 1),
('Configuración de usuario', 6),
('Configuración de impresora', 1),
('Configuración de seguridad', 6),
('Configuración de energía', 1),
('Configuración de audio', 3),
('Configuración de teclado', 1),
('Configuración de sistema', 6),
('Configuración de accesorios', 1);
INSERT INTO DETALLES (caracteristica, idCaracteristica, idConfiguracion) VALUES
('Brillo y contraste ajustables', 1, 1),
('Conexión Wi-Fi y Ethernet', 2, 2),
('Perfil de usuario personalizado', 3, 3),
('Soporte para impresión a doble cara', 4, 4),
('Cifrado de datos habilitado', 5, 5),
('Modo ahorro de energía activado', 6, 6),
('Control de volumen y ecualizador', 7, 7),
('Distribución de teclas en español', 8, 8),
('Actualizaciones automáticas activadas', 9, 9),
('Compatibilidad con dispositivos Bluetooth', 10, 10);
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2024 a las 08:55:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mediccare`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Apellido` varchar(255) NOT NULL,
  `Cedula` varchar(20) NOT NULL,
  `Puesto` varchar(255) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Sexo` enum('Masculino','Femenino','Otro') NOT NULL,
  `Correo_Electronico` varchar(255) NOT NULL,
  `Contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `Nombre`, `Apellido`, `Cedula`, `Puesto`, `Fecha_Nacimiento`, `Sexo`, `Correo_Electronico`, `Contrasena`) VALUES
(1, 'MIGUEL', 'GUILLEN', '4012346577', 'Gerente', '2024-04-19', 'Masculino', 'ELMIGUEL1998@GMAIL.COM', '$2y$10$GWPHyOu7cb20incwQhnznu4ZVeCdadYNd61pPdZq3GT9qm2mXQ5/G'),
(2, 'Geral', 'Santis', '4012346578', 'Gerente', '2024-05-14', 'Otro', 'ELMIGUEL1998@GMAIL.COM', '$2y$10$uYTYJsvXZNdLKX8PtSUSQO4/yUl70b0Y6pkOHNkHC4Q3jpqZ3aWGe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autoriservmed`
--

CREATE TABLE `autoriservmed` (
  `AutorizacionID` int(11) NOT NULL,
  `Asegurado_ID` int(11) DEFAULT NULL,
  `ProveedorMedico_ID` int(11) DEFAULT NULL,
  `Fecha_Solicitud_Servi` date DEFAULT NULL,
  `Descripcion_Servi` varchar(50) DEFAULT NULL,
  `Estado_AutriServ` varchar(25) DEFAULT NULL,
  `Fecha_Autorizacion_Serv` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centroatenmedi`
--

CREATE TABLE `centroatenmedi` (
  `CentroAtencionMed` int(11) NOT NULL,
  `Nombre_Centro` varchar(25) DEFAULT NULL,
  `Direccion_CentroAntencionMed` varchar(50) DEFAULT NULL,
  `Telefono_CentroAtencionMed` varchar(12) DEFAULT NULL,
  `Correo_Ele_CentroAtencionMed` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clinicas`
--

CREATE TABLE `clinicas` (
  `ClinicaID` int(11) NOT NULL,
  `Nombre_Cli` varchar(100) DEFAULT NULL,
  `Direccion_Cli` varchar(50) DEFAULT NULL,
  `Telefono_Cli` varchar(12) DEFAULT NULL,
  `Correo_Ele_Cli` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clinicas`
--

INSERT INTO `clinicas` (`ClinicaID`, `Nombre_Cli`, `Direccion_Cli`, `Telefono_Cli`, `Correo_Ele_Cli`) VALUES
(3, 'Clínica Abreu', 'Avenida Abraham Lincoln #417, Santo Domingo', '809-555-1234', 'info@clinicaabreu.com.do'),
(4, 'Centro Médico Cibao', 'Calle Duarte #43, Santiago de los Caballeros', '809-222-5678', 'info@centromedicocibao.co'),
(5, 'Hospital General Plaza de la Salud', 'Avenida Bolívar #159, Santo Domingo', '809-333-9876', 'info@plazadelasalud.com.d'),
(6, 'Clínica Corazones Unidos', 'Calle José Martí #56, Santo Domingo Este', '809-444-4321', 'info@corazonesunidos.com.'),
(7, 'Centro Médico UCE', 'Calle César Nicolás Penson #86, Santo Domingo', '809-666-7890', 'info@centromedicouce.com.'),
(8, 'Geral', 'UASD', '8295612844', 'ELMIGUEL1998@GMAIL.COM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumo`
--

CREATE TABLE `consumo` (
  `id` int(11) NOT NULL,
  `cedula_pasaporte` varchar(20) NOT NULL,
  `prestador` varchar(100) NOT NULL,
  `monto_autorizado` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consumo`
--

INSERT INTO `consumo` (`id`, `cedula_pasaporte`, `prestador`, `monto_autorizado`, `fecha`, `estado`, `tipo`) VALUES
(1, '4012346577', 'Prestador 1', 150.00, '2024-04-30', 'En proceso', 'Tipo A'),
(2, '4012346577', 'Prestador 1', 200.00, '2024-04-28', 'Aprobado', 'Tipo B'),
(3, '4012346577', 'Prestador 2', 180.50, '2024-04-25', 'En proceso', 'Tipo C'),
(4, '4012346572', 'Prestador 2', 180.50, '2024-04-25', 'En proceso', 'Tipo C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependiente`
--

CREATE TABLE `dependiente` (
  `id` int(11) NOT NULL,
  `Titular_ID` int(11) DEFAULT NULL,
  `Nombre_Depe` varchar(25) DEFAULT NULL,
  `Apellido_Depe` varchar(50) DEFAULT NULL,
  `Cedula_Depe` varchar(15) DEFAULT NULL,
  `Relacion_Depe_Titu` varchar(25) DEFAULT NULL,
  `Fecha_Naci_Depe` date DEFAULT NULL,
  `Sexo_Depe` varchar(15) DEFAULT NULL,
  `Correo_Ele_Depe` varchar(25) DEFAULT NULL,
  `Estado` varchar(20) NOT NULL DEFAULT 'En Revisión',
  `cedula_pasaporte` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dependiente`
--

INSERT INTO `dependiente` (`id`, `Titular_ID`, `Nombre_Depe`, `Apellido_Depe`, `Cedula_Depe`, `Relacion_Depe_Titu`, `Fecha_Naci_Depe`, `Sexo_Depe`, `Correo_Ele_Depe`, `Estado`, `cedula_pasaporte`) VALUES
(9, 2147483647, 'MIGUEL', 'GUILLEN', '4012346577', 'padre', '2024-05-09', 'masculino', 'ELMIGUEL1998@GMAIL.COM', 'En Revisión', '4012346572');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_adjuntos`
--

CREATE TABLE `documentos_adjuntos` (
  `id` int(11) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  `nombre_archivo` varchar(100) NOT NULL,
  `ruta_archivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `FacturaID` int(11) NOT NULL,
  `Asegurado_I_D` int(11) DEFAULT NULL,
  `Monto_Factura` decimal(10,2) DEFAULT NULL,
  `Fecha_Factura` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farmacia`
--

CREATE TABLE `farmacia` (
  `FarmaciaID` int(11) NOT NULL,
  `Nombre_Farmacia` varchar(100) DEFAULT NULL,
  `Direccion_Farm` varchar(50) DEFAULT NULL,
  `Telefono_Farm` varchar(12) DEFAULT NULL,
  `Correo_Ele_Farm` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `farmacia`
--

INSERT INTO `farmacia` (`FarmaciaID`, `Nombre_Farmacia`, `Direccion_Farm`, `Telefono_Farm`, `Correo_Ele_Farm`) VALUES
(1, 'Farmacia Carol', 'Calle El Conde #105, Santo Domingo', '809-111-2222', 'info@farmaciacarol.com.do'),
(2, 'Farmacia Los Hidalgos', 'Avenida Charles de Gaulle #45, Santo Domingo Este', '809-333-4444', 'info@farmacialoshidalgos.'),
(3, 'Farmacia Inca', 'Calle José Martí #25, Santiago de los Caballeros', '809-555-6666', 'info@farmaciainca.com.do'),
(4, 'Farmacia San Miguel', 'Avenida Estrella Sadhalá, Santiago de los Caballer', '809-777-8888', 'info@farmaciasanmiguel.co'),
(5, 'Farmacia La Hora', 'Avenida Winston Churchill #205, Santo Domingo', '809-888-9999', 'info@farmacialahora.com.d');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_medico`
--

CREATE TABLE `historial_medico` (
  `HistorialMedicoID` int(11) NOT NULL,
  `Asegurado_id` int(11) DEFAULT NULL,
  `Descripcion_Medica` varchar(150) DEFAULT NULL,
  `Fecha_Consulta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_medico`
--

INSERT INTO `historial_medico` (`HistorialMedicoID`, `Asegurado_id`, `Descripcion_Medica`, `Fecha_Consulta`) VALUES
(1, 2, 'edd', '2024-04-30'),
(2, 2, 'edd', '2024-04-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospitales`
--

CREATE TABLE `hospitales` (
  `HospitalID` int(11) NOT NULL,
  `Nombre_Hos` varchar(100) DEFAULT NULL,
  `Direccion_Hos` varchar(50) DEFAULT NULL,
  `Telefono_Hos` varchar(12) DEFAULT NULL,
  `Correo_Ele_Hos` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hospitales`
--

INSERT INTO `hospitales` (`HospitalID`, `Nombre_Hos`, `Direccion_Hos`, `Telefono_Hos`, `Correo_Ele_Hos`) VALUES
(1, 'Hospital General de la Plaza de la Salud', 'Avenida Bolívar #159, Santo Domingo', '809-333-9876', 'info@plazadelasalud.com.d'),
(2, 'Hospital Metropolitano de Santiago (HOMS)', 'Autopista Duarte, Santiago de los Caballeros', '809-222-5678', 'info@homs.com.do'),
(3, 'Hospital Dr. Dario Contreras', 'Autopista Duarte, Km 10 1/2, Santo Domingo', '809-555-1234', 'info@hospitaldariocontrer'),
(4, 'Hospital Materno Infantil San Lorenzo de Los Mina', 'Avenida San Vicente de Paul, Santo Domingo Este', '809-444-4321', 'info@hospitalsanlorenzo.c'),
(5, 'Hospital Traumatológico Ney Arias Lora', 'Autopista Duarte, Santo Domingo Norte', '809-666-7890', 'info@hospitalneyariaslora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `MedicamentoID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Fabricante` varchar(100) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `FechaExpiracion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`MedicamentoID`, `Nombre`, `Descripcion`, `Fabricante`, `Precio`, `Stock`, `FechaExpiracion`) VALUES
(1, 'Paracetamol', 'Analgesico y antifebril', 'Farmacia ABC', 5.99, 100, '2024-12-31'),
(2, 'Ibuprofeno', 'Antiinflamatorio y analgésico', 'Laboratorios XYZ', 8.50, 80, '2025-06-30'),
(3, 'Amoxicilina', 'Antibiótico', 'Laboratorios A', 12.75, 50, '2023-09-15'),
(4, 'Omeprazol', 'Inhibidor de la bomba de protones', 'Farmaceutica Z', 7.25, 120, '2024-03-20'),
(5, 'Loratadina', 'Antihistamínico', 'Laboratorios B', 6.30, 90, '2024-11-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nuevos_productos`
--

CREATE TABLE `nuevos_productos` (
  `id` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'En revisión'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `PagoID` int(11) NOT NULL,
  `id_Asegurado` int(11) DEFAULT NULL,
  `ID_Proveedor` int(11) DEFAULT NULL,
  `Monto_Pago` decimal(10,2) DEFAULT NULL,
  `Fecha_Pago` date DEFAULT NULL,
  `Estado_Pago` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `duracion_meses` int(11) NOT NULL,
  `estado` varchar(20) DEFAULT 'En proceso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plan`
--

INSERT INTO `plan` (`id`, `nombre`, `descripcion`, `precio`, `duracion_meses`, `estado`) VALUES
(1, 'Plan Básico', 'Incluye servicios básicos de salud.', 1000.00, 12, 'En proceso'),
(2, 'Plan Completo', 'Incluye servicios completos de salud.', 4000.00, 12, 'En proceso'),
(3, 'Plan Voluntario', 'Plan con servicios opcionales de salud.', 2000.00, 12, 'En proceso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_usuario`
--

CREATE TABLE `plan_usuario` (
  `id` int(11) NOT NULL,
  `cedula_pasaporte` varchar(20) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `fecha_seleccion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(20) DEFAULT 'En proceso',
  `coberturaPlan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plan_usuario`
--

INSERT INTO `plan_usuario` (`id`, `cedula_pasaporte`, `plan_id`, `fecha_seleccion`, `estado`, `coberturaPlan`) VALUES
(4, '4012346572', 3, '2024-05-06 15:44:19', 'En proceso', NULL),
(5, '4012346572', 2, '2024-05-07 05:34:24', 'En proceso', NULL),
(6, '4012346572', 3, '2024-05-07 05:34:40', 'En proceso', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preautorizaciones`
--

CREATE TABLE `preautorizaciones` (
  `id` int(11) NOT NULL,
  `cedula_pasaporte` varchar(20) NOT NULL,
  `prestador` varchar(100) NOT NULL,
  `monto_solicitado` decimal(10,2) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `estado` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preautorizaciones`
--

INSERT INTO `preautorizaciones` (`id`, `cedula_pasaporte`, `prestador`, `monto_solicitado`, `fecha_solicitud`, `estado`, `tipo`) VALUES
(1, '4012346577', 'Prestador 2', 100000.00, '2024-05-03', 'En proceso', 'clinica'),
(2, '4012346577', 'Prestador 2', 100000.00, '2024-05-03', 'En proceso', 'clinica'),
(3, '4012346577', 'Prestador 1', 200000.00, '2024-05-15', 'En proceso', 'trtg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestador`
--

CREATE TABLE `prestador` (
  `id` int(11) NOT NULL,
  `nombre_prestador` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestador`
--

INSERT INTO `prestador` (`id`, `nombre_prestador`, `direccion`, `telefono`, `email`) VALUES
(1, 'Prestador 1', 'Dirección 1', '123456789', 'prestador1@example.com'),
(2, 'Prestador 2', 'Dirección 2', '987654321', 'prestador2@example.com'),
(3, 'Prestador 3', 'Dirección 3', '555555555', 'prestador3@example.com'),
(4, 'MIGUEL', 'UASD', '8295612843', 'elmiguel1998@live.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedoresmedicos`
--

CREATE TABLE `proveedoresmedicos` (
  `ProveedorMedicoID` int(11) NOT NULL,
  `Nombre_Prov` varchar(50) DEFAULT NULL,
  `Especialidad_Prov` varchar(50) DEFAULT NULL,
  `Direccion_Prov` varchar(50) DEFAULT NULL,
  `Telefono_Prov` varchar(12) DEFAULT NULL,
  `Correo_Ele_Prov` varchar(25) DEFAULT NULL,
  `Horario_Atencion_Prov` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedoresmedicos`
--

INSERT INTO `proveedoresmedicos` (`ProveedorMedicoID`, `Nombre_Prov`, `Especialidad_Prov`, `Direccion_Prov`, `Telefono_Prov`, `Correo_Ele_Prov`, `Horario_Atencion_Prov`) VALUES
(1, 'MIGUEL', 'Medico', 'UASD', '8295612843', 'elmiguel1998@live.com', NULL),
(2, 'MIGUEL', 'Medico', 'UASD', '8295612843', 'elmiguel1998@live.com', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamaciones`
--

CREATE TABLE `reclamaciones` (
  `ReclamacionID` int(11) NOT NULL,
  `ID_Asegurado` int(11) DEFAULT NULL,
  `Fecha_Reclamacion` date DEFAULT NULL,
  `Descripcion_reclamacion` varchar(255) DEFAULT NULL,
  `Estado_Reclamacion` varchar(25) DEFAULT NULL,
  `Monto_Reclamo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_reembolso`
--

CREATE TABLE `solicitud_reembolso` (
  `id` int(11) NOT NULL,
  `cedula_pasaporte` varchar(20) NOT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp(),
  `monto` decimal(10,2) NOT NULL,
  `estado` varchar(20) DEFAULT 'En proceso',
  `descripcion` text DEFAULT NULL,
  `archivo_adjunto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_reembolso`
--

INSERT INTO `solicitud_reembolso` (`id`, `cedula_pasaporte`, `fecha_solicitud`, `monto`, `estado`, `descripcion`, `archivo_adjunto`) VALUES
(1, '4012346572', '2024-05-03 00:30:17', 2000.00, 'Aprobado', 'ytjyjyjy', 'documentos/Trabajo final.pdf'),
(2, '4012346572', '2024-05-03 00:36:15', 2000.00, 'En proceso', 'ytjyjyjy', 'documentos/Trabajo final.pdf'),
(3, '4012346572', '2024-05-05 04:15:31', 2000.00, 'En proceso', 'guhgrghohg', 'documentos/Licenciatura-en-Enfermeria-80603.pdf'),
(4, '4012346572', '2024-05-07 05:28:52', 2000.00, 'En proceso', 'Hola', 'documentos/Yenifer Méndez Florián.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientomedi`
--

CREATE TABLE `tratamientomedi` (
  `TratamientoID` int(11) NOT NULL,
  `Id_Asegurado` int(11) DEFAULT NULL,
  `Proveedor_ID` int(11) DEFAULT NULL,
  `Descripcion_Tratamiento` varchar(100) DEFAULT NULL,
  `Fecha_Ini_Tratamiento` date DEFAULT NULL,
  `Fecha_Fin_Tratamiento` date DEFAULT NULL,
  `Estado_Tratamiento` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cedula_pasaporte` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellido`, `cedula_pasaporte`, `correo`, `fecha_nacimiento`, `telefono`, `contrasena`) VALUES
('MIGUEL', 'GUILLEN', '4012346572', 'ELMIGUEL1998@GMAIL.COM', '2024-04-18', '8295612844', '$2y$10$6JjD/rVu0Z3cbwneB5LBOe5pZjhyx5zU0psixqaXslYu5BWgaCpUi'),
('MIGUEL', 'GUILLEN', '4012346574', 'ELMIGUEL1998@GMAIL.COM', '2024-05-16', '8295612843', '$2y$10$o9kbyu08XGz7KRSvc/JFbucIJHybxJXDA5pGRV.KDyBg3/JejelKy'),
('MIGUEL', 'GUILLEN', '4012346577', 'ELMIGUEL1998@GMAIL.COM', '2024-04-18', '8295612843', '123'),
('Amado', 'Ruiz', '4012346579', 'ELMIGUEL1998@GMAIL.COM', '2024-05-22', '8295612843', '$2y$10$yuyZtI9TCdfmCDRtIjMDuuPB/2GN5yB52AQOnpeNJUzLU1MlYj8fu');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `autoriservmed`
--
ALTER TABLE `autoriservmed`
  ADD PRIMARY KEY (`AutorizacionID`);

--
-- Indices de la tabla `centroatenmedi`
--
ALTER TABLE `centroatenmedi`
  ADD PRIMARY KEY (`CentroAtencionMed`);

--
-- Indices de la tabla `clinicas`
--
ALTER TABLE `clinicas`
  ADD PRIMARY KEY (`ClinicaID`);

--
-- Indices de la tabla `consumo`
--
ALTER TABLE `consumo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_consumo_usuario` (`cedula_pasaporte`);

--
-- Indices de la tabla `dependiente`
--
ALTER TABLE `dependiente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documentos_adjuntos`
--
ALTER TABLE `documentos_adjuntos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_id` (`solicitud_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`FacturaID`);

--
-- Indices de la tabla `farmacia`
--
ALTER TABLE `farmacia`
  ADD PRIMARY KEY (`FarmaciaID`);

--
-- Indices de la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  ADD PRIMARY KEY (`HistorialMedicoID`);

--
-- Indices de la tabla `hospitales`
--
ALTER TABLE `hospitales`
  ADD PRIMARY KEY (`HospitalID`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`MedicamentoID`);

--
-- Indices de la tabla `nuevos_productos`
--
ALTER TABLE `nuevos_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`PagoID`);

--
-- Indices de la tabla `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plan_usuario`
--
ALTER TABLE `plan_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preautorizaciones`
--
ALTER TABLE `preautorizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_preautorizaciones_usuario` (`cedula_pasaporte`);

--
-- Indices de la tabla `prestador`
--
ALTER TABLE `prestador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedoresmedicos`
--
ALTER TABLE `proveedoresmedicos`
  ADD PRIMARY KEY (`ProveedorMedicoID`);

--
-- Indices de la tabla `reclamaciones`
--
ALTER TABLE `reclamaciones`
  ADD PRIMARY KEY (`ReclamacionID`);

--
-- Indices de la tabla `solicitud_reembolso`
--
ALTER TABLE `solicitud_reembolso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula_pasaporte` (`cedula_pasaporte`);

--
-- Indices de la tabla `tratamientomedi`
--
ALTER TABLE `tratamientomedi`
  ADD PRIMARY KEY (`TratamientoID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cedula_pasaporte`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `autoriservmed`
--
ALTER TABLE `autoriservmed`
  MODIFY `AutorizacionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `centroatenmedi`
--
ALTER TABLE `centroatenmedi`
  MODIFY `CentroAtencionMed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clinicas`
--
ALTER TABLE `clinicas`
  MODIFY `ClinicaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `consumo`
--
ALTER TABLE `consumo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `dependiente`
--
ALTER TABLE `dependiente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `documentos_adjuntos`
--
ALTER TABLE `documentos_adjuntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `FacturaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `farmacia`
--
ALTER TABLE `farmacia`
  MODIFY `FarmaciaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  MODIFY `HistorialMedicoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `hospitales`
--
ALTER TABLE `hospitales`
  MODIFY `HospitalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `MedicamentoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `nuevos_productos`
--
ALTER TABLE `nuevos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `PagoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `plan_usuario`
--
ALTER TABLE `plan_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `preautorizaciones`
--
ALTER TABLE `preautorizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prestador`
--
ALTER TABLE `prestador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proveedoresmedicos`
--
ALTER TABLE `proveedoresmedicos`
  MODIFY `ProveedorMedicoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reclamaciones`
--
ALTER TABLE `reclamaciones`
  MODIFY `ReclamacionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_reembolso`
--
ALTER TABLE `solicitud_reembolso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tratamientomedi`
--
ALTER TABLE `tratamientomedi`
  MODIFY `TratamientoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consumo`
--
ALTER TABLE `consumo`
  ADD CONSTRAINT `fk_consumo_usuario` FOREIGN KEY (`cedula_pasaporte`) REFERENCES `usuario` (`cedula_pasaporte`);

--
-- Filtros para la tabla `documentos_adjuntos`
--
ALTER TABLE `documentos_adjuntos`
  ADD CONSTRAINT `documentos_adjuntos_ibfk_1` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud_reembolso` (`id`);

--
-- Filtros para la tabla `preautorizaciones`
--
ALTER TABLE `preautorizaciones`
  ADD CONSTRAINT `fk_preautorizaciones_usuario` FOREIGN KEY (`cedula_pasaporte`) REFERENCES `usuario` (`cedula_pasaporte`);

--
-- Filtros para la tabla `solicitud_reembolso`
--
ALTER TABLE `solicitud_reembolso`
  ADD CONSTRAINT `solicitud_reembolso_ibfk_1` FOREIGN KEY (`cedula_pasaporte`) REFERENCES `usuario` (`cedula_pasaporte`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

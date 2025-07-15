-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2022 at 07:32 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'admin', 'admin123', 'Darwin', 'RG', 'admin-profile.png', '2018-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `reference_number` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `status` int(1) NOT NULL,
  `time_out` time DEFAULT NULL,
  `num_hr` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `reference_number` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `program` varchar(100) NOT NULL,
  `year_level` varchar(10) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `reference_number`, `firstname`, `mname`, `lastname`, `email`, `phone`, `address`, `program`, `year_level`, `created_on`) VALUES
(1, '2500001', 'Maria', 'Santos', 'Cruz', 'maria.cruz@email.com', '09123456789', '123 Rizal Street, Manila', 'Computer Science', '1', '2024-01-15'),
(2, '2500002', 'Juan', 'Carlos', 'Santos', 'juan.santos@email.com', '09234567890', '456 Bonifacio Avenue, Quezon City', 'Information Technology', '2', '2024-01-15'),
(3, '2500003', 'Ana', 'Maria', 'Garcia', 'ana.garcia@email.com', '09345678901', '789 Mabini Road, Makati', 'Business Administration', '1', '2024-01-15'),
(4, '2500004', 'Pedro', 'Jose', 'Reyes', 'pedro.reyes@email.com', '09456789012', '321 Aguinaldo Boulevard, Pasig', 'Computer Engineering', '3', '2024-01-15'),
(5, '2500005', 'Carmen', 'Luz', 'Martinez', 'carmen.martinez@email.com', '09567890123', '654 Luna Street, Mandaluyong', 'Accountancy', '2', '2024-01-15'),
(6, '2500006', 'Antonio', 'Miguel', 'Lopez', 'antonio.lopez@email.com', '09678901234', '987 Del Pilar Avenue, Taguig', 'Computer Science', '1', '2024-01-15'),
(7, '2500007', 'Isabel', 'Clara', 'Gonzalez', 'isabel.gonzalez@email.com', '09789012345', '147 Burgos Street, Marikina', 'Information Technology', '2', '2024-01-15'),
(8, '2500008', 'Luis', 'Fernando', 'Rodriguez', 'luis.rodriguez@email.com', '09890123456', '258 Roxas Boulevard, Parañaque', 'Business Administration', '1', '2024-01-15'),
(9, '2500009', 'Elena', 'Victoria', 'Perez', 'elena.perez@email.com', '09901234567', '369 Quezon Avenue, Caloocan', 'Computer Engineering', '3', '2024-01-15'),
(10, '2500010', 'Roberto', 'Antonio', 'Torres', 'roberto.torres@email.com', '09012345678', '741 Marcos Highway, Antipolo', 'Accountancy', '2', '2024-01-15'),
(11, '2500011', 'Sofia', 'Isabella', 'Flores', 'sofia.flores@email.com', '09123456789', '852 Commonwealth Avenue, Quezon City', 'Computer Science', '1', '2024-01-15'),
(12, '2500012', 'Carlos', 'Manuel', 'Rivera', 'carlos.rivera@email.com', '09234567890', '963 EDSA, Makati', 'Information Technology', '2', '2024-01-15'),
(13, '2500013', 'Gabriela', 'Elena', 'Morales', 'gabriela.morales@email.com', '09345678901', '159 Katipunan Avenue, Quezon City', 'Business Administration', '1', '2024-01-15'),
(14, '2500014', 'Diego', 'Rafael', 'Ortiz', 'diego.ortiz@email.com', '09456789012', '357 Ortigas Avenue, Pasig', 'Computer Engineering', '3', '2024-01-15'),
(15, '2500015', 'Valentina', 'Carmen', 'Silva', 'valentina.silva@email.com', '09567890123', '486 Shaw Boulevard, Mandaluyong', 'Accountancy', '2', '2024-01-15'),
(16, '2500016', 'Miguel', 'Angel', 'Vargas', 'miguel.vargas@email.com', '09678901234', '753 C5 Road, Taguig', 'Computer Science', '1', '2024-01-15'),
(17, '2500017', 'Camila', 'Sofia', 'Castro', 'camila.castro@email.com', '09789012345', '951 Aurora Boulevard, Quezon City', 'Information Technology', '2', '2024-01-15'),
(18, '2500018', 'Alejandro', 'Jose', 'Mendoza', 'alejandro.mendoza@email.com', '09890123456', '264 España Boulevard, Manila', 'Business Administration', '1', '2024-01-15'),
(19, '2500019', 'Lucia', 'Ana', 'Herrera', 'lucia.herrera@email.com', '09901234567', '837 Taft Avenue, Manila', 'Computer Engineering', '3', '2024-01-15'),
(20, '2500020', 'Fernando', 'Luis', 'Jimenez', 'fernando.jimenez@email.com', '09012345678', '429 Lacson Avenue, Manila', 'Accountancy', '2', '2024-01-15'),
(21, '2500021', 'Adriana', 'Maria', 'Moreno', 'adriana.moreno@email.com', '09123456789', '573 Blumentritt Street, Manila', 'Computer Science', '1', '2024-01-15'),
(22, '2500022', 'Ricardo', 'Carlos', 'Alvarez', 'ricardo.alvarez@email.com', '09234567890', '816 Quirino Avenue, Manila', 'Information Technology', '2', '2024-01-15'),
(23, '2500023', 'Daniela', 'Isabel', 'Romero', 'daniela.romero@email.com', '09345678901', '295 Nagtahan Street, Manila', 'Business Administration', '1', '2024-01-15'),
(24, '2500024', 'Javier', 'Antonio', 'Navarro', 'javier.navarro@email.com', '09456789012', '748 Legarda Street, Manila', 'Computer Engineering', '3', '2024-01-15'),
(25, '2500025', 'Valeria', 'Elena', 'Ruiz', 'valeria.ruiz@email.com', '09567890123', '361 Dimasalang Street, Manila', 'Accountancy', '2', '2024-01-15'),
(26, '2500026', 'Andres', 'Miguel', 'Dominguez', 'andres.dominguez@email.com', '09678901234', '594 Sampaloc Street, Manila', 'Computer Science', '1', '2024-01-15'),
(27, '2500027', 'Natalia', 'Carmen', 'Ramos', 'natalia.ramos@email.com', '09789012345', '827 Mendiola Street, Manila', 'Information Technology', '2', '2024-01-15'),
(28, '2500028', 'Santiago', 'Luis', 'Torres', 'santiago.torres@email.com', '09890123456', '154 San Miguel Avenue, Manila', 'Business Administration', '1', '2024-01-15'),
(29, '2500029', 'Isabella', 'Sofia', 'Gutierrez', 'isabella.gutierrez@email.com', '09901234567', '487 Ayala Avenue, Makati', 'Computer Engineering', '3', '2024-01-15'),
(30, '2500030', 'Mateo', 'Jose', 'Vega', 'mateo.vega@email.com', '09012345678', '729 Paseo de Roxas, Makati', 'Accountancy', '2', '2024-01-15'),
(31, '2500031', 'Victoria', 'Ana', 'Cruz', 'victoria.cruz@email.com', '09123456789', '362 Gil Puyat Avenue, Makati', 'Computer Science', '1', '2024-01-15'),
(32, '2500032', 'Sebastian', 'Carlos', 'Reyes', 'sebastian.reyes@email.com', '09234567890', '695 Chino Roces Avenue, Makati', 'Information Technology', '2', '2024-01-15'),
(33, '2500033', 'Sofia', 'Elena', 'Morales', 'sofia.morales@email.com', '09345678901', '928 Kalayaan Avenue, Makati', 'Business Administration', '1', '2024-01-15'),
(34, '2500034', 'Leonardo', 'Antonio', 'Ortiz', 'leonardo.ortiz@email.com', '09456789012', '251 Buendia Avenue, Makati', 'Computer Engineering', '3', '2024-01-15'),
(35, '2500035', 'Emilia', 'Maria', 'Silva', 'emilia.silva@email.com', '09567890123', '584 South Luzon Expressway, Makati', 'Accountancy', '2', '2024-01-15'),
(36, '2500036', 'Rafael', 'Miguel', 'Vargas', 'rafael.vargas@email.com', '09678901234', '917 McKinley Road, Makati', 'Computer Science', '1', '2024-01-15'),
(37, '2500037', 'Luna', 'Isabel', 'Castro', 'luna.castro@email.com', '09789012345', '340 Lawton Avenue, Makati', 'Information Technology', '2', '2024-01-15'),
(38, '2500038', 'Adrian', 'Jose', 'Mendoza', 'adrian.mendoza@email.com', '09890123456', '673 J.P. Rizal Street, Makati', 'Business Administration', '1', '2024-01-15'),
(39, '2500039', 'Aurora', 'Carmen', 'Herrera', 'aurora.herrera@email.com', '09901234567', '906 Makati Avenue, Makati', 'Computer Engineering', '3', '2024-01-15'),
(40, '2500040', 'Felix', 'Luis', 'Jimenez', 'felix.jimenez@email.com', '09012345678', '239 Pasong Tamo Street, Makati', 'Accountancy', '2', '2024-01-15'),
(41, '2500041', 'Catalina', 'Ana', 'Moreno', 'catalina.moreno@email.com', '09123456789', '572 Pasong Tirad Street, Makati', 'Computer Science', '1', '2024-01-15'),
(42, '2500042', 'Hugo', 'Carlos', 'Alvarez', 'hugo.alvarez@email.com', '09234567890', '805 Pasong Kalye Street, Makati', 'Information Technology', '2', '2024-01-15'),
(43, '2500043', 'Mariana', 'Elena', 'Romero', 'mariana.romero@email.com', '09345678901', '138 Pasong Palad Street, Makati', 'Business Administration', '1', '2024-01-15'),
(44, '2500044', 'Maximo', 'Antonio', 'Navarro', 'maximo.navarro@email.com', '09456789012', '471 Pasong Palad Extension, Makati', 'Computer Engineering', '3', '2024-01-15'),
(45, '2500045', 'Paloma', 'Maria', 'Ruiz', 'paloma.ruiz@email.com', '09567890123', '704 Pasong Palad Road, Makati', 'Accountancy', '2', '2024-01-15'),
(46, '2500046', 'Tomas', 'Miguel', 'Dominguez', 'tomas.dominguez@email.com', '09678901234', '937 Pasong Palad Avenue, Makati', 'Computer Science', '1', '2024-01-15'),
(47, '2500047', 'Esperanza', 'Sofia', 'Ramos', 'esperanza.ramos@email.com', '09789012345', '170 Pasong Palad Boulevard, Makati', 'Information Technology', '2', '2024-01-15'),
(48, '2500048', 'Ignacio', 'Luis', 'Torres', 'ignacio.torres@email.com', '09890123456', '403 Pasong Palad Highway, Makati', 'Business Administration', '1', '2024-01-15'),
(49, '2500049', 'Consuelo', 'Isabel', 'Gutierrez', 'consuelo.gutierrez@email.com', '09901234567', '636 Pasong Palad Expressway, Makati', 'Computer Engineering', '3', '2024-01-15'),
(50, '2500050', 'Arturo', 'Jose', 'Vega', 'arturo.vega@email.com', '09012345678', '869 Pasong Palad Parkway, Makati', 'Accountancy', '2', '2024-01-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

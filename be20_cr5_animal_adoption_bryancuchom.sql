-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 02:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be20_cr5_animal_adoption_bryancuchom`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animal_id` int(11) NOT NULL,
  `animal_name` varchar(255) NOT NULL,
  `price` decimal(13,2) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `vaccinated` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `fk_animal_id` int(11) DEFAULT NULL,
  `fk_pet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animal_id`, `animal_name`, `price`, `photo`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`, `fk_animal_id`, `fk_pet_id`) VALUES
(13, 'Whiskers', 200.00, '6563e78a799df.jpg', 'Vienna', 'A playful kitten', 'Small', '5 year', 'Yes', 'Siamese', 0, NULL, 0),
(14, 'Rex', 300.00, '6563e4c95836a.jpg', 'Vienna', 'A loyal dog', 'Large', '5 years', 'Yes', 'German Shepherd', 0, NULL, 0),
(15, 'Spike', 150.00, '6563e4e25fd5a.jpg', 'Vienna', 'A friendly reptile', 'Medium', '2 years', 'No', 'Bearded Dragon', 1, NULL, 0),
(16, 'Mittens', 250.00, '6563e5057020c.jpg', 'Vienna', 'A cuddly kitten', 'Small', '1 year', 'Yes', 'Persian', 1, NULL, 0),
(17, 'Fido', 350.00, '6563e518abb8b.jpg', 'Vienna', 'An energetic dog', 'Medium', '3 years', 'Yes', 'Labrador Retriever', 1, NULL, 0),
(18, 'Slither', 100.00, '6563e531f2407.jpg', 'Vienna', 'A fascinating reptile', 'Large', '5 years', 'No', 'Chameleon', 1, NULL, 0),
(19, 'Paws', 200.00, '6563e55db0bf2.jpg', 'Vienna', 'A curious kitten', 'Small', '1 year', 'Yes', 'Maine Coon', 1, NULL, 0),
(20, 'Spot', 300.00, '6563e5d1b53e4.jpeg', 'Vienna', 'A protective dog', 'Large', 'Large', 'Yes', 'Golden Retriever', 1, NULL, 0),
(22, 'Fluffy', 250.00, '6563e5717db46.jpg', 'Vienna', 'A fluffy little one', 'Small', '1 year', 'Yes', 'Chiuaua', 1, NULL, 0),
(23, 'Buddy', 350.00, '6563e6b0d2dbb.jpg', 'Vienna', 'A friendly dog', 'Medium', '4 years', 'Yes', 'Golden Retriever', 1, NULL, 0),
(27, 'Bella', 500.00, '6563e5f4acc52.jpg', 'Vienna', 'Very friendly dog.', 'Large', '5 years', 'Yes', 'Labrador', 1, NULL, 0),
(28, 'Flufffy 2', 350.00, '6563e590007e6.jpg', 'Vienna', 'An energetic lovely little rodent', 'Large', '1 years ', 'Yes', 'Rodent/ Chinchilla', 1, NULL, 0),
(29, 'Mittens', 250.00, '6563e698e14b2.jpg', 'Vienna', 'A cuddly kitten.', 'small', '4 years', 'yes', 'Persian Cat', 1, NULL, 0),
(30, 'test', 123.00, 'default.jpg', 'ketenbruckengasse 12', 'test', 'small', '5', 'yes', 'labrador', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `pet_id` int(11) NOT NULL,
  `pet_adoption_date` date NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_animal_id` int(11) NOT NULL,
  `adoption_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user',
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `password`, `phone_number`, `date_of_birth`, `address`, `picture`, `status`, `fk_user_id`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', 'hashed_password1', 1234567890, '1980-01-01', '123 Main St', NULL, 'user', 0),
(2, 'Jane', 'Doe', 'jane.doe@example.com', 'hashed_password2', 1234567891, '1985-02-02', '456 Maple Ave', '656371dc1178e.jpg', 'user', 0),
(3, 'Jim', 'Smith', 'jim.smith@example.com', 'hashed_password3', 1234567892, '1990-03-03', '789 Oak Dr', '6563721e8c971.jpg', 'user', 0),
(4, 'Jill', 'Johnson', 'jill.johnson@example.com', 'hashed_password4', 1234567893, '1995-04-04', '321 Pine Ln', '65637239c63da.jpg', 'user', 0),
(5, 'Joe', 'Brown', 'joe.brown@example.com', 'hashed_password5', 1234567894, '2000-05-05', '654 Elm St', '65637255ab613.jpg', 'user', 0),
(6, 'Julie', 'Davis', 'julie.davis@example.com', 'hashed_password6', 1234567895, '2005-06-06', '987 Cedar Ave', '65637282225af.jpg', 'user', 0),
(7, 'Jerry', 'Miller', 'jerry.miller@example.com', 'hashed_password7', 1234567896, '2010-07-07', '345 Birch Ln', '6563729538a97.jpg', 'user', 0),
(8, 'Jessica', 'Wilson', 'jessica.wilson@example.com', 'hashed_password8', 1234567897, '2015-08-08', '678 Willow Dr', '656372a8020aa.jpg', 'user', 0),
(9, 'Jeff', 'Moore', 'jeff.moore@example.com', 'hashed_password9', 1234567898, '2020-09-09', '1012 Cherry St', NULL, 'user', 0),
(10, 'Jennifer', 'Taylor', 'jennifer.taylor@example.com', 'hashed_password10', 1234567899, '2025-10-10', '3456 Peachtree Ave', NULL, 'user', 0),
(11, 'asdasd', 'asdad', 'rat@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 123123123, '2012-03-12', '123123', '6563726e3e2b7.jpg', 'user', 0),
(12, 'Bryan', 'Mamani', 'peterpane@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 660113822, '2012-03-12', 'Landstrasser Gurtel 44', '65628261a27ce.jpeg', 'adm', 0),
(13, 'BryanJ', 'cucho', 'bryancucho@gmail.com', '123456', 601138845, '4444-04-04', 'Landstrasser', '656227c3b0678.jpg', 'user', 0),
(14, 'tester', 'tester', 'tester@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1138845, '0000-00-00', 'Landstra', '6563522934b72.jpg', 'user', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_id`),
  ADD KEY `fk_pet_id` (`fk_animal_id`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_animal_id` (`fk_animal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`fk_animal_id`) REFERENCES `pet_adoption` (`pet_id`) ON DELETE SET NULL;

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`fk_animal_id`) REFERENCES `animals` (`animal_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

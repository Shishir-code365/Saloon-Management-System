-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 07:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_username`, `admin_password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `service` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `name`, `email`, `phone`, `gender`, `appointment_date`, `appointment_time`, `service`, `user_id`, `status`) VALUES
(140, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-03', '11:30:00', 'service', 108, 'paid'),
(142, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-02', '12:30:00', 'Gold Facial', 108, 'unpaid'),
(143, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-02', '12:00:00', 'Yo Yo Haircut', 108, 'unpaid'),
(144, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-04', '12:30:00', 'Gold Facial', 108, 'unpaid'),
(153, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-05', '12:00:00', 'Bridal Makeup', 108, 'unpaid'),
(154, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-05', '12:30:00', 'Fruit Facial', 108, 'unpaid'),
(155, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-05', '13:00:00', 'Fruit Facial', 108, 'unpaid'),
(156, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-05', '13:30:00', 'Yo Yo Haircut', 108, 'unpaid'),
(157, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-05', '09:00:00', 'Fruit Facial', 108, 'unpaid'),
(162, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-12', '09:00:00', 'Hair Cut', 108, 'unpaid'),
(165, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-22', '15:30:00', 'Fruit Facial', 108, 'unpaid'),
(166, 'user1', 'dhakal.shishir2009@gmail.com', 9845789621, 'male', '2024-05-22', '17:00:00', 'Bridal Makeup', 41, 'unpaid'),
(168, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-23', '12:30:00', 'Fruit Facial', 108, 'unpaid'),
(170, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-24', '08:00:00', 'Yo Yo Haircut', 108, 'unpaid'),
(172, 'vasco1', 'vasco13@gmail.com', 0, 'transgender', '2024-05-24', '09:30:00', 'Fruit Facial', 110, 'unpaid'),
(173, 'kiran35', 'kiran25@gmail.com', 9712345688, 'male', '2024-05-24', '15:30:00', 'Hair Cut', 111, 'unpaid'),
(174, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-24', '10:00:00', 'Hair Cut', 108, 'unpaid'),
(175, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-27', '12:00:00', 'Style Haircut', 108, 'unpaid'),
(176, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-27', '16:00:00', 'Hair Wash', 108, 'unpaid'),
(177, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-30', '11:30:00', 'Traditional Cut', 108, 'unpaid'),
(178, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-31', '15:00:00', 'Yo Yo Haircut', 108, 'unpaid'),
(179, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-06-01', '08:00:00', 'Normal Pedicure', 108, 'unpaid'),
(180, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-05-31', '15:30:00', 'Gold Facial', 108, 'unpaid'),
(183, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-06-17', '15:00:00', 'Traditional Cut', 108, 'unpaid'),
(184, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-06-15', '18:00:00', 'Traditional Cut', 108, 'paid'),
(185, 'user1', 'dhakal.shishir2009@gmail.com', 9845789621, 'male', '2024-06-15', '18:30:00', 'Hair Wash', 41, 'unpaid'),
(186, 'user', 'user1@gmail.com', 9874569857, 'male', '2024-06-17', '13:30:00', 'Traditional Cut', 108, 'paid'),
(187, 'shishir255', 'dhakal.sh22@gmail.com', 9845555558, 'male', '2024-06-17', '10:00:00', 'Gold Facial', 122, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_price` int(11) NOT NULL,
  `service_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `service_price`, `service_description`) VALUES
(1, 'Fruit Facial', 500, 'If its a peel-off mask, it also works as an excellent exfoliator, ridding the skin of dead cells.'),
(2, 'Charcoal Facial', 1000, 'The end result is skin that is clean and clear. When used as a powder, charcoal masks can reach deep in your pores and suck out impurities with them.'),
(3, 'Deluxe Manicure', 500, 'The end result is skin that is clean and clear. When used as a powder, charcoal masks can reach deep in your pores and suck out impurities with them.'),
(4, 'Deluxe Pedicure', 600, 'A pedicure is a therapeutic treatment for your feet that removes dead skin, softens hard skin and shapes and treats your toenails.'),
(5, 'Normal Manicure', 300, 'A pedicure is a therapeutic treatment for your feet that removes dead skin, softens hard skin and shapes and treats your toenails.'),
(6, 'Normal Pedicure', 400, 'A pedicure is a therapeutic treatment for your feet that removes dead skin, softens hard skin and shapes and treats your toenails.'),
(7, 'Hair Cut', 250, 'A hairstyle, hairdo, or haircut refers to the styling of hair, usually on the human scalp. Sometimes, this could also mean an editing of facial or body hair.'),
(8, 'Style Haircut', 550, 'A hairstyle, hairdo, or haircut refers to the styling of hair, usually on the human scalp. Sometimes, this could also mean an editing of facial or body hair.'),
(9, 'Hair Wash', 300, 'A hairstyle, hairdo, or haircut refers to the styling of hair, usually on the human scalp. Sometimes, this could also mean an editing of facial or body hair.'),
(10, 'Traditional Cut', 45, 'A pedicure is a therapeutic treatment for your feet that removes dead skin, softens hard skin and shapes and treats your toenails.'),
(11, 'Yo Yo Haircut', 100, 'Yo Yo haircut'),
(17, 'Gold Facial', 800, 'Gold facial is a facial treatment that includes the application of a face mask made with 24-carat gold foil. It helps in rejuvenating the skin and reducing wrinkles.'),
(18, 'Aromatherapy Massage', 1200, 'Aromatherapy massage uses essential oils derived from plants to provide therapeutic benefits. It helps in relieving stress, promoting relaxation, and improving overall well-being.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `original_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `phone`, `Name`, `original_password`) VALUES
(37, 'user23', '9937e348bbae4623de914d08ff1a05aa', 'w@gmail.com', 9845628302, 'Shishir Dhakal', NULL),
(41, 'user1', 'ee11cbb19052e40b07aac0ca060c23ee', 'dhakal.shishir2009@gmail.com', 9845789621, 'user', NULL),
(42, 'nishan223', '2088f10212c0d95657ad431ad9f46df8', 'nishan223@gmail.com', 9847637272, 'Nishan Gurung', NULL),
(44, 'basantauser', 'ee11cbb19052e40b07aac0ca060c23ee', 'basanta1234@gmail.com', 9844554455, 'basanta Dhakal', NULL),
(46, 'user3', '92877af70a45fd6a2ed7fe81e1236b78', 'user3@gmail.com', 9876453637, 'user three', NULL),
(47, 'user4', '3f02ebe3d7929b091e3d8ccfde2f3bc6', 'user4@gmail.com', 9845688888, 'user four', NULL),
(48, 'user5', '0a791842f52a0acfbb3a783378c066b8', 'user5@gmail.com', 9844444444, 'user five', NULL),
(51, 'user8', '7668f673d5669995175ef91b5d171945', 'user8@gmail.com', 9845555555, 'user8', NULL),
(54, 'kk', 'dc468c70fb574ebd07287b38d0d0676d', 'KK@gmail.com', 9877777777, 'Shishir2222', NULL),
(70, 'shishir59', 'e6053eb8d35e02ae40beeeacef203c1a', 't@gmail.com', 9875632069, 'shishir dhakal', NULL),
(71, 'dhakalshishir22', '1a1dc91c907325c69271ddf0c944bc72', 'u@gmail.com', 9837676767, 'Shishir Dhakal', NULL),
(72, 'dhakalshishir56', '1a1dc91c907325c69271ddf0c944bc72', 'k@gmail.com', 9874563215, 'Shishir Dhakal', NULL),
(73, 'wukopigyv', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'nilih@mailinator.com', 9874622365, 'Maryam Henry', NULL),
(74, 'jecopuqydu', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'dotezibaj@mailinator.com', 9875623125, 'Lani Vang', NULL),
(75, 'wyxahevys', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'suno@mailinator.com', 9854545565, 'Hector Greene', NULL),
(76, 'rodiva', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'ratesudihu@mailinator.com', 9875632001, 'Demetrius Hurley', NULL),
(77, 'pegyjagos', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'sobide@mailinator.com', 9845525855, 'Malachi Barr', NULL),
(78, 'foramufi', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'giwyg@mailinator.com', 9856325636, 'Thomas Burgess', NULL),
(79, 'vogyga', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'cysavewifa@mailinator.com', 9856321564, 'Salvador Hunt', NULL),
(80, 'kykuzov', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'cydipyhif@mailinator.com', 9863201568, 'Isabella Chavez', NULL),
(81, 'gucozenoc', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'wyvefes@mailinator.com', 9845632159, 'Martena Medina', NULL),
(83, 'tokutyfot', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'syqag@mailinator.com', 9812365495, 'Graiden Williams', NULL),
(84, 'sufyreqo', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'qocifijehy@mailinator.com', 9563214896, 'May Byrd', NULL),
(85, 'vonat', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'dupobado@mailinator.com', 9845632257, 'Finn Matthews', NULL),
(86, 'fywupuvez', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'jucohyjyg@mailinator.com', 9856321569, 'Ursa Wade', NULL),
(87, 'fenebem', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'pihoxotebe@mailinator.com', 9863210325, 'Rebekah Rosales', NULL),
(88, 'lyhop', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'wilyzapywe@mailinator.com', 9865321565, 'Jonas Love', NULL),
(89, 'bytuqo', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'jakamajop@mailinator.com', 9845632569, 'Katell Chang', NULL),
(90, 'zoboz', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'vepurejike@mailinator.com', 9874563203, 'Elvis Alston', NULL),
(91, 'witesogy', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'dififazo@mailinator.com', 9874632031, 'Daniel Herman', NULL),
(92, 'xisakuzil', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'vywagom@mailinator.com', 9874632125, 'Alan Duncan', NULL),
(93, 'gerotacuf', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'zivakabyl@mailinator.com', 9874563217, 'Carter Moran', NULL),
(94, 'byhowema', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'kaxupe@mailinator.com', 9845769325, 'Nigel Watson', NULL),
(95, 'daxaxizid', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'ryputi@mailinator.com', 9874563985, 'Macon Frye', NULL),
(99, 'Shishir5050', '9937e348bbae4623de914d08ff1a05aa', 'dhakal.shishir2069@gmail.com', 9874569852, 'Shishir Dhakal', NULL),
(104, 'qokywo', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'fobiwatu@mailinator.com', 9855655555, 'Rhea Clemons', 'Pa$$w0rd!'),
(105, 'qicaco', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'ficux@mailinator.com', 9785444888, 'Irene Clements', 'Pa$$w0rd!'),
(106, 'woduqigyh', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'wecenu@mailinator.com', 9744444444, 'Katell Hammond', 'Pa$$w0rd!'),
(107, 'user12332111', 'ee11cbb19052e40b07aac0ca060c23ee', 'useruse211r@gmail.com', 9785632282, 'user', 'user'),
(108, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user1@gmail.com', 9874569857, 'user name', 'user'),
(109, 'lezat', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'bilyh@mailinator.com', 9875698533, 'Sharon Albert', 'Pa$$w0rd!'),
(110, 'vasco1', 'ee08e8fb0b55ba1706bf4ca7cebb2cd5', 'vasco13@gmail.com', 9829295789, 'vasco', 'vasco123'),
(111, 'kiran35', '5f4dcc3b5aa765d61d8327deb882cf99', 'kiran25gmail.com', 9712345688, 'kiran ghimire', 'password'),
(112, 'hotafusupe', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'kedocalycymailinator.com', 9755554649, 'Zachery Hendrix', 'Pa$$w0rd!'),
(113, 'qaxut', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'qohiruqilemailinator.com', 9875698423, 'Mikayla Farley', 'Pa$$w0rd!'),
(114, 'jiwuziri', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'qekakmailinator.com', 9874569856, 'Keane Dean', 'Pa$$w0rd!'),
(115, 'shishir11', '7b1fd2d96f079dc3401a3062134ab9cc', 'dhakalshishir2gmail.com', 9874569999, 'Shishir Dhakal', 'shishir'),
(116, 'shishir23', '7b1fd2d96f079dc3401a3062134ab9cc', 'dhakal.shishir2059@gmail', 9856555555, 'shishir', 'shishir'),
(121, 'shishir2', '7b1fd2d96f079dc3401a3062134ab9cc', 'dhakalshisi2dhk@gmail.com', 9874552555, 'shishir', 'shishir'),
(122, 'shishir255', '7b1fd2d96f079dc3401a3062134ab9cc', 'dhakal.sh22@gmail.com', 9845555558, 'Shishir Another', 'shishir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
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
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

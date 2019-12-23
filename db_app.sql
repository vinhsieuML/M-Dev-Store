
CREATE DATABASE db_app;

USE db_app;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_app`
--
-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` ( `name`, `image`) VALUES
('SHOES', ''),
('CLOTHING', ''),
('ACCESSORIES', '');
-- --------------------------------------------------------

CREATE TABLE `collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------
CREATE TABLE `hang` (
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` varchar(100) DEFAULT NULL,
`image` varchar(100)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(100) UNIQUE KEY DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL,
  `price` float DEFAULT '0',
  `description` text NOT NULL,
  `new` tinyint(4) NOT NULL DEFAULT '0',
  `collectionID` int(11) DEFAULT NULL,
  `id_hang` int(11) NOT NULL,
  `status` nvarchar(10),
  foreign key (id_type) references product_type(id),
  foreign key (id_hang) references hang(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--





-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `link` varchar(500) NOT NULL,
  `id_product` int(11) NOT NULL,
  foreign key (id_product) references product(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--




CREATE TABLE `size` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_type` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  foreign key (id_type) references product_type(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `size` (`id_type`, `name`) VALUES
(1,'8.5'),
(1,'9'),
(1,'9.5'),
(1,'10'),
(1,'10.5'),
(1,'11'),
(1,'11.5'),
(1,'12'),
(2,'S'),
(2,'M'),
(2,'L'),
(2,'XL'),
(2,'XXL'),
(2,'XXXL');

CREATE TABLE `size_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_size` int(11) NOT NULL,
  `id_product`int(11) NOT NULL,
  `number` int (11) DEFAULT '100',
  foreign key (id_size) references size(id),
  foreign key (id_product) references product(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(255) UNIQUE KEY,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Table structure for table `bill`
--



CREATE TABLE `bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_customer` int(11) NOT NULL,
  `date_order` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` float NOT NULL DEFAULT '0',
  `note` text,
  `status` tinyint(4) DEFAULT '0', -- 0 la cho duyet cod, 1 la da thanh toan online,2 da huy online, 3 dang giao hang, 4 thanh cong
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `check_out_id` varchar(255) DEFAULT NULL,
  `check_out_date` datetime DEFAULT NULL,
  `magiaodich`	varchar(255) DEFAULT NULL,
  `url_payment` varchar(255) DEFAULT NULL,
  foreign key (id_customer) references users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_bill` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` float DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `id_size_detail` int(11),
  foreign key (id_size_detail) references size_detail(id),
  foreign key (id_bill) references bill(id),
  foreign key (id_product) references product(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_detail`
--

-- --------------------------------------------------------
CREATE TABLE `cart_detail`(
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `id_customer` int(11) NOT NULL,
 `id_product` int(11) NOT NULL,
 `quantity` float DEFAULT '0',
 `id_size_detail` int(11),
 foreign key(id_customer) references users(id),
 foreign key (id_product) references product(id),
 foreign key (id_size_detail) references size_detail(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `admin`(
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(10) NOT NULL,
    `image` varchar(10),
    `username` varchar(10) NOT NULL,
    `password` varchar(10) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `admin` (`name`, `image`, `username`,`password`) VALUES
('SieuDang','null','admin','admin');
CREATE TABLE `boxes_section`(
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`box_tile` TEXT NOT NULL,
`box_desc` TEXT NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `slider`(
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`slider_name` nvarchar(100),
`slider_url` nvarchar(255),
`slider_image` nvarchar(20) 
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `terms`(
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`slide_name` varchar(255) NOT NULL,
`slide_image` text NOT NULL,
`slide_url` varchar(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

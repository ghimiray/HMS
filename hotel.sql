-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2016 at 03:59 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`hotel`@`localhost` PROCEDURE `get_available_rooms` (IN `o_room_type` VARCHAR(50), IN `o_checkin_date` VARCHAR(50), IN `o_checkout_date` VARCHAR(50))  BEGIN
SELECT * FROM `room` WHERE room_type=o_room_type AND NOT EXISTS (
SELECT room_id FROM reservation WHERE reservation.room_id=room.room_id AND checkout_date >= o_checkin_date AND checkin_date <= o_checkout_date
UNION ALL
SELECT room_id FROM room_sales WHERE room_sales.room_id=room.room_id AND checkout_date >= o_checkin_date AND checkin_date <= o_checkout_date
);
END$$

CREATE DEFINER=`hotel`@`localhost` PROCEDURE `get_customers` (IN `today_date` VARCHAR(50))  BEGIN
SELECT * FROM `room_sales` NATURAL JOIN `customer` WHERE checkout_date >= today_date AND checkin_date <= today_date;
END$$

CREATE DEFINER=`hotel`@`localhost` PROCEDURE `todays_service_count` (IN `today_date` VARCHAR(50))  BEGIN
SELECT count(*) as amount, "laundry" as type FROM laundry_service WHERE laundry_date=today_date UNION ALL SELECT count(*) as amount, "massage" as type FROM massage_service WHERE massage_date=today_date UNION ALL SELECT count(*) as amount, "roomservice" as type FROM get_roomservice WHERE roomservice_date=today_date UNION ALL SELECT count(*) as amount, "medicalservice" as type FROM get_medicalservice WHERE medicalservice_date=today_date UNION ALL SELECT count(*) as amount, "sport" as type FROM do_sport WHERE dosport_date=today_date
UNION ALL SELECT count(*) as amount, "restaurant" as type FROM restaurant_booking WHERE book_date=today_date;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `config_id` int(11) NOT NULL,
  `config_key` varchar(100) NOT NULL,
  `config_value` varchar(100) DEFAULT NULL,
  `description` text,
  `config_type` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`config_id`, `config_key`, `config_value`, `description`, `config_type`, `date_created`) VALUES
(1, 'name', 'Kathmandu Hotel', NULL, 'information', '2016-09-05 15:53:14'),
(2, 'slogan', 'xx', NULL, 'information', '2016-09-05 15:53:14'),
(3, 'established', 'xxx', NULL, 'information', '2016-09-05 15:53:14'),
(4, 'service_email', 'xx', NULL, 'information', '2016-09-05 15:53:14'),
(5, 'contact_email', 'xx', NULL, 'information', '2016-09-05 15:53:14'),
(6, 'website', 'xx', NULL, 'information', '2016-09-05 15:53:14'),
(7, 'website_title', 'xx', NULL, 'information', '2016-09-05 15:53:14'),
(8, 'about_us', NULL, 'xxWe are this and that', 'about', '2016-09-05 15:53:14'),
(9, 'about_us_short', NULL, 'xx', 'about', '2016-09-05 15:53:14'),
(10, 'privacy_policy', NULL, 'xx', 'legal', '2016-09-05 15:53:14'),
(11, 'terms_condition', NULL, 'xx', 'legal', '2016-09-05 15:53:14'),
(12, 'facebook', 'xx', NULL, 'social', '2016-09-05 15:53:14'),
(13, 'twitter', 'xx', NULL, 'social', '2016-09-05 15:53:14'),
(14, 'google', 'xx', NULL, 'social', '2016-09-05 15:53:14'),
(15, 'address', 'xx', NULL, 'information', '2016-09-05 16:24:47'),
(16, 'city', 'xx', NULL, 'information', '2016-09-05 16:24:47'),
(17, 'country', 'xx', NULL, 'information', '2016-09-05 16:24:47'),
(18, 'contact_one', 'xx', NULL, 'information', '2016-09-05 16:24:47'),
(19, 'contact_two', 'xx', NULL, 'information', '2016-09-05 16:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People''s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People''s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'YU', 'Yugoslavia'),
(244, 'ZR', 'Zaire'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_firstname` varchar(50) NOT NULL,
  `customer_lastname` varchar(50) NOT NULL,
  `customer_TCno` varchar(11) NOT NULL,
  `customer_city` varchar(50) DEFAULT NULL,
  `customer_country` varchar(50) DEFAULT NULL,
  `customer_telephone` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_firstname`, `customer_lastname`, `customer_TCno`, `customer_city`, `customer_country`, `customer_telephone`, `customer_email`) VALUES
(1, 'Arjun', 'Paudel', '2', 'Ktm', 'Nepal', '9841', 'ar@c.a'),
(2, 'Arjun', 'Paudel', '1', 'Ktm', 'Nepal', '98', 'ar@c.a');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `department_budget` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `department_budget`) VALUES
(1, 'Company', 100),
(2, 'Employee', 100000),
(3, 'Reservation', 100000),
(4, 'Rooms', 100000),
(5, 'Departments', 100000),
(6, 'Restaurants and Menu', 100000),
(7, 'Sports Facility', 100000),
(8, 'Transport', 100000),
(9, 'Events', 100000),
(10, 'Parking', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `do_sport`
--

CREATE TABLE `do_sport` (
  `customer_id` int(11) NOT NULL,
  `sportfacility_id` int(11) NOT NULL,
  `dosport_date` varchar(50) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `dosport_details` text,
  `dosport_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `do_sport`
--
DELIMITER $$
CREATE TRIGGER `after_insert_sport_service` AFTER INSERT ON `do_sport` FOR EACH ROW BEGIN
    UPDATE room_sales SET room_sales.total_service_price = room_sales.total_service_price + NEW.dosport_price WHERE room_sales.customer_id = NEW.customer_id AND room_sales.checkin_date <= NEW.dosport_date AND room_sales.checkout_date >= NEW.dosport_date;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_sport_service` BEFORE DELETE ON `do_sport` FOR EACH ROW BEGIN
    UPDATE room_sales SET room_sales.total_service_price = room_sales.total_service_price - OLD.dosport_price WHERE room_sales.customer_id = OLD.customer_id AND room_sales.checkin_date <= OLD.dosport_date AND room_sales.checkout_date >= OLD.dosport_date;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_username` varchar(50) NOT NULL,
  `employee_password` varchar(50) CHARACTER SET utf32 NOT NULL,
  `employee_firstname` varchar(50) NOT NULL,
  `employee_lastname` varchar(50) NOT NULL,
  `employee_telephone` varchar(50) DEFAULT NULL,
  `employee_email` varchar(50) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `employee_type` varchar(50) NOT NULL,
  `employee_salary` float DEFAULT NULL,
  `employee_hiring_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_username`, `employee_password`, `employee_firstname`, `employee_lastname`, `employee_telephone`, `employee_email`, `department_id`, `employee_type`, `employee_salary`, `employee_hiring_date`) VALUES
(1, 'shyam', 'apple123', 'arjun', 'paudel', '9841187158', 'arjuninsight@gmail.com', 3, 'A', 10000, '2012-10-2');

-- --------------------------------------------------------

--
-- Table structure for table `get_medicalservice`
--

CREATE TABLE `get_medicalservice` (
  `customer_id` int(11) NOT NULL,
  `medicalservice_id` int(11) NOT NULL,
  `medicalservice_date` varchar(50) CHARACTER SET utf8 NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `getmedicalservice_details` text CHARACTER SET utf8,
  `medicalservice_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Triggers `get_medicalservice`
--
DELIMITER $$
CREATE TRIGGER `after_delete_medical_service` BEFORE DELETE ON `get_medicalservice` FOR EACH ROW BEGIN
    UPDATE room_sales SET room_sales.total_service_price = room_sales.total_service_price - OLD.medicalservice_price WHERE room_sales.customer_id = OLD.customer_id AND room_sales.checkin_date <= OLD.medicalservice_date AND room_sales.checkout_date >= OLD.medicalservice_date;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_medical_service` AFTER INSERT ON `get_medicalservice` FOR EACH ROW BEGIN
    UPDATE room_sales SET room_sales.total_service_price = room_sales.total_service_price + NEW.medicalservice_price WHERE room_sales.customer_id = NEW.customer_id AND room_sales.checkin_date <= NEW.medicalservice_date AND room_sales.checkout_date >= NEW.medicalservice_date;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `get_roomservice`
--

CREATE TABLE `get_roomservice` (
  `customer_id` int(11) NOT NULL,
  `roomservice_id` int(11) NOT NULL,
  `roomservice_date` varchar(50) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `getroomservice_details` text,
  `roomservice_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `get_roomservice`
--
DELIMITER $$
CREATE TRIGGER `after_insert_room_service` AFTER INSERT ON `get_roomservice` FOR EACH ROW BEGIN
    UPDATE room_sales SET room_sales.total_service_price = room_sales.total_service_price + NEW.roomservice_price WHERE room_sales.customer_id = NEW.customer_id AND room_sales.checkin_date <= NEW.roomservice_date AND room_sales.checkout_date >= NEW.roomservice_date;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_room_service` BEFORE DELETE ON `get_roomservice` FOR EACH ROW BEGIN
    UPDATE room_sales SET room_sales.total_service_price = room_sales.total_service_price - OLD.roomservice_price WHERE room_sales.customer_id = OLD.customer_id AND room_sales.checkin_date <= OLD.roomservice_date AND room_sales.checkout_date >= OLD.roomservice_date;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'employee', 'Employee'),
(3, 'customer', 'Service Using Customers');

-- --------------------------------------------------------

--
-- Table structure for table `laundry`
--

CREATE TABLE `laundry` (
  `laundry_id` int(11) NOT NULL,
  `laundry_open_time` varchar(50) DEFAULT NULL,
  `laundry_close_time` varchar(50) DEFAULT NULL,
  `laundry_details` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `laundry_service`
--

CREATE TABLE `laundry_service` (
  `customer_id` int(11) NOT NULL,
  `laundry_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `laundry_date` varchar(50) DEFAULT NULL,
  `laundry_amount` int(11) DEFAULT NULL,
  `laundry_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `laundry_service`
--
DELIMITER $$
CREATE TRIGGER `after_insert_laundry_service` AFTER INSERT ON `laundry_service` FOR EACH ROW BEGIN
    UPDATE room_sales SET room_sales.total_service_price = room_sales.total_service_price + NEW.laundry_price WHERE room_sales.customer_id = NEW.customer_id AND room_sales.checkin_date <= NEW.laundry_date AND room_sales.checkout_date >= NEW.laundry_date;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_laundry_service` BEFORE DELETE ON `laundry_service` FOR EACH ROW BEGIN
    UPDATE room_sales SET room_sales.total_service_price = room_sales.total_service_price - OLD.laundry_price WHERE room_sales.customer_id = OLD.customer_id AND room_sales.checkin_date <= OLD.laundry_date AND room_sales.checkout_date >= OLD.laundry_date;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `massage_room`
--

CREATE TABLE `massage_room` (
  `massageroom_id` int(11) NOT NULL,
  `massageroom_open_time` varchar(10) DEFAULT NULL,
  `massageroom_close_time` varchar(10) DEFAULT NULL,
  `massageroom_details` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `massage_service`
--

CREATE TABLE `massage_service` (
  `customer_id` int(11) NOT NULL,
  `massageroom_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `massage_date` varchar(50) DEFAULT NULL,
  `massage_details` text,
  `massage_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `massage_service`
--
DELIMITER $$
CREATE TRIGGER `after_insert_massage_service` AFTER INSERT ON `massage_service` FOR EACH ROW BEGIN
    UPDATE room_sales SET room_sales.total_service_price = room_sales.total_service_price + NEW.massage_price WHERE room_sales.customer_id = NEW.customer_id AND room_sales.checkin_date <= NEW.massage_date AND room_sales.checkout_date >= NEW.massage_date;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_massage_service` BEFORE DELETE ON `massage_service` FOR EACH ROW BEGIN
    UPDATE room_sales SET room_sales.total_service_price = room_sales.total_service_price - OLD.massage_price WHERE room_sales.customer_id = OLD.customer_id AND room_sales.checkin_date <= OLD.massage_date AND room_sales.checkout_date >= OLD.massage_date;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `medical_service`
--

CREATE TABLE `medical_service` (
  `medicalservice_id` int(11) NOT NULL,
  `medicalservice_open_time` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `medicalservice_close_time` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `medicalservice_details` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `medical_service`
--

INSERT INTO `medical_service` (`medicalservice_id`, `medicalservice_open_time`, `medicalservice_close_time`, `medicalservice_details`) VALUES
(1, '10', '18', 'Medical Service');

-- --------------------------------------------------------

--
-- Table structure for table `menu_categories`
--

CREATE TABLE `menu_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `restaurant_name` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_categories`
--

INSERT INTO `menu_categories` (`id`, `name`, `parent_id`, `restaurant_name`, `description`, `image`) VALUES
(1, 'Nepali Cuisine', 0, 'KTM Restaurant', 'WOWOOW', 'ktm-restaurant-nepali-cuisine.jpg'),
(2, 'Indian Cuishine', 0, 'KTM Restaurant', 'Indian Cuishine', 'ktm-restaurant-indian-cuishine.jpg'),
(7, 'Nepali Khana', 0, 'Thakali Bhansa Ghar', 'Yo Nepali khana ho', 'thakali-bhansa-ghar-nepali-khana.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `category_id`, `name`, `description`, `image`, `date_created`) VALUES
(1, 1, 'Nepali Rice Meal', 'Daal Bhat and Tarkari', 'ktm-restaurant-nepali-cuisine-nepali-rice-meal1.jpg', '2016-09-24 01:31:03'),
(2, 1, 'Sel Roti', 'Sel Roti', 'ktm-restaurant-nepali-cuisine-sel-roti.jpg', '2016-09-23 20:35:02'),
(3, 1, 'Yomari', 'Yomari, a newari food', 'ktm-restaurant-nepali-cuisine-yomari.jpg', '2016-09-23 20:36:46'),
(4, 2, 'Paratha', 'Indian Paratha with Butter/Cheese and Chatni', 'ktm-restaurant-indian-cuishine-paratha.jpg', '2016-09-23 20:53:00'),
(8, 7, 'Daal Bhat Tarkari', 'Yo Daal Vaat tarkari vishwakai utrikasta chha', 'thakali-bhansa-ghar-nepali-khana-daal-bhat-tarkari.jpg', '2016-09-24 03:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reservation_id` varchar(100) NOT NULL,
  `payer_name` varchar(100) NOT NULL,
  `payer_email` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `currency` varchar(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_id`, `reservation_id`, `payer_name`, `payer_email`, `amount`, `currency`, `date_created`) VALUES
(1, 11, '1,2,', 'Arjun Paudel', 'paypal-sandbox@everestbits.com', 6000, 'USD', '2016-09-25 05:51:53'),
(2, 11, '3,', 'Arjun Paudel', 'paypal-sandbox@everestbits.com', 3000, 'USD', '2016-09-25 05:54:16'),
(3, 11, '4,', 'Arjun Paudel', 'paypal-sandbox@everestbits.com', 10000, 'USD', '2016-09-25 06:15:05'),
(4, 11, '5,6,', 'Arjun Paudel', 'paypal-sandbox@everestbits.com', 6000, 'USD', '2016-09-25 15:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `reservation_price` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `customer_id`, `room_id`, `checkin_date`, `checkout_date`, `employee_id`, `reservation_date`, `reservation_price`, `status`) VALUES
(1, 11, 401, '2016-09-25', '2016-09-26', 0, '2016-09-25', 3000, NULL),
(2, 11, 402, '2016-09-25', '2016-09-26', 0, '2016-09-25', 3000, NULL),
(3, 11, 403, '2016-09-29', '2016-09-30', 0, '2016-09-25', 3000, NULL),
(4, 11, 201, '2016-09-25', '2016-09-26', 0, '2016-09-25', 10000, NULL),
(5, 11, 403, '2016-09-25', '2016-09-26', 0, '2016-09-25', 3000, NULL),
(6, 11, 404, '2016-09-25', '2016-09-26', 0, '2016-09-25', 3000, NULL),
(7, 7, 201, '2016-09-27', '2016-09-27', 1, '2016-09-27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `restaurant_name` varchar(50) NOT NULL,
  `restaurant_open_time` varchar(10) DEFAULT NULL,
  `restaurant_close_time` varchar(10) DEFAULT NULL,
  `restaurant_details` text,
  `table_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurant_name`, `restaurant_open_time`, `restaurant_close_time`, `restaurant_details`, `table_count`) VALUES
('KTM Restaurant', '06:00', '18:00', '', 25),
('Thakali Bhansa Ghar', '8:00', '21:00', 'This is detail					', 10);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_booking`
--

CREATE TABLE `restaurant_booking` (
  `id` int(11) NOT NULL,
  `restaurant_name` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `book_date` varchar(50) NOT NULL,
  `table_number` int(11) DEFAULT NULL,
  `book_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurant_booking`
--

INSERT INTO `restaurant_booking` (`id`, `restaurant_name`, `customer_id`, `book_date`, `table_number`, `book_price`) VALUES
(1, 'KTM Restaurant', 11, '2016-09-25', 1, 0),
(2, 'KTM Restaurant', 11, '2016-09-25', 2, 0),
(3, 'KTM Restaurant', 11, '2016-09-25', 3, 0),
(4, 'KTM Restaurant', 11, '2016-09-25', 20, 0),
(5, 'KTM Restaurant', 11, '2016-09-25', 21, 0),
(6, 'KTM Restaurant', 11, '2016-09-25', 4, 0),
(8, 'KTM Restaurant', 11, '2016-09-25', 4, 0),
(9, 'KTM Restaurant', 11, '2016-09-25', 4, 0),
(10, 'KTM Restaurant', 11, '2016-09-25', 4, 0),
(11, 'KTM Restaurant', 11, '2016-09-25', 4, 0),
(12, 'KTM Restaurant', 11, '2016-09-25', 5, 0),
(13, 'KTM Restaurant', 11, '2016-09-25', 6, 0),
(14, 'KTM Restaurant', 11, '2016-09-25', 7, 0),
(15, 'KTM Restaurant', 11, '2016-09-25', 8, 0),
(16, 'Thakali Bhansa Ghar', 11, '2016-09-25', 1, 0),
(17, 'KTM Restaurant', 11, '2016-09-25', 9, 0),
(18, 'KTM Restaurant', 11, '2016-09-25', 10, 0),
(19, 'KTM Restaurant', 11, '2016-09-25', 11, 0);

--
-- Triggers `restaurant_booking`
--
DELIMITER $$
CREATE TRIGGER `after_insert_restaurant_service` AFTER INSERT ON `restaurant_booking` FOR EACH ROW BEGIN
    UPDATE room_sales SET room_sales.total_service_price = room_sales.total_service_price + NEW.book_price WHERE room_sales.customer_id = NEW.customer_id AND room_sales.checkin_date <= NEW.book_date AND room_sales.checkout_date >= NEW.book_date;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_restaurant_service` BEFORE DELETE ON `restaurant_booking` FOR EACH ROW BEGIN
    UPDATE room_sales SET room_sales.total_service_price = room_sales.total_service_price - OLD.book_price WHERE room_sales.customer_id = OLD.customer_id AND room_sales.checkin_date <= OLD.book_date AND room_sales.checkout_date >= OLD.book_date;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_type`) VALUES
(201, 'Deluxe'),
(202, 'Deluxe'),
(203, 'Deluxe'),
(204, 'Deluxe'),
(205, 'Deluxe'),
(206, 'Deluxe'),
(207, 'Deluxe'),
(208, 'Deluxe'),
(209, 'Deluxe'),
(210, 'Deluxe'),
(401, 'General'),
(402, 'General'),
(403, 'General'),
(404, 'General'),
(405, 'General'),
(406, 'General'),
(407, 'General'),
(408, 'General'),
(409, 'General'),
(410, 'General'),
(301, 'Luxury'),
(302, 'Luxury'),
(303, 'Luxury'),
(304, 'Luxury'),
(305, 'Luxury'),
(306, 'Luxury'),
(307, 'Luxury'),
(308, 'Luxury'),
(309, 'Luxury'),
(310, 'Luxury');

--
-- Triggers `room`
--
DELIMITER $$
CREATE TRIGGER `after_insert_room` AFTER INSERT ON `room` FOR EACH ROW BEGIN
    UPDATE room_type SET room_type.room_quantity =room_type.room_quantity + 1 WHERE room_type.room_type = NEW.room_type;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_room` BEFORE DELETE ON `room` FOR EACH ROW BEGIN
    UPDATE room_type SET room_type.room_quantity =room_type.room_quantity - 1 WHERE room_type.room_type = OLD.room_type;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `room_sales`
--

CREATE TABLE `room_sales` (
  `customer_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `checkin_date` varchar(50) NOT NULL,
  `checkout_date` varchar(50) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `room_sales_price` float DEFAULT NULL,
  `total_service_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room_service`
--

CREATE TABLE `room_service` (
  `roomservice_id` int(11) NOT NULL,
  `roomservice_open_time` varchar(50) DEFAULT NULL,
  `roomservice_close_time` varchar(50) DEFAULT NULL,
  `roomservice_floor` varchar(50) DEFAULT NULL,
  `roomservice_details` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `room_type` varchar(50) NOT NULL,
  `room_price` int(11) DEFAULT NULL,
  `room_details` text,
  `room_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`room_type`, `room_price`, `room_details`, `room_quantity`) VALUES
('Deluxe', 10000, 'This is detail', 10),
('General', 3000, 'Normal Rooms', 10),
('Luxury', 6500, 'Luxury Rooms', 10);

-- --------------------------------------------------------

--
-- Table structure for table `sport_facilities`
--

CREATE TABLE `sport_facilities` (
  `sportfacility_id` int(11) NOT NULL,
  `sportfacility_open_time` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sportfacility_close_time` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sportfacility_details` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `id` int(11) NOT NULL,
  `number` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `seats` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`id`, `number`, `type`, `color`, `seats`, `price`, `date_created`) VALUES
(2, 'ABC4099', 'Car', 'Black Blue', 4, '100', '2016-09-27 04:13:22'),
(3, 'ABC5099', 'Car', 'Shining Black', 5, '120', '2016-09-27 04:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `transport_booking`
--

CREATE TABLE `transport_booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transport_id` int(11) NOT NULL,
  `pickup` varchar(100) NOT NULL,
  `dropping` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `cost_per_day` decimal(10,0) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(2) NOT NULL,
  `password_raw` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `employee_id`, `department_id`, `group_id`, `address`, `country`, `password_raw`) VALUES
(1, '::1', '', '$2y$08$zWAxE5f.UaRP7UlLxPD05ud9tnaGje/CWQy/tQpm14dDqWedSzv06', '', 'hobo2rist@gmail.com', NULL, NULL, NULL, NULL, 1471918362, 1474978126, 1, 'Arjun', 'Paudel', NULL, '9841187158', 0, 0, 1, '', '', ''),
(7, '::1', '', '$2y$08$zWAxE5f.UaRP7UlLxPD05ud9tnaGje/CWQy/tQpm14dDqWedSzv06', '', 'arjuninsight@gmail.com', NULL, NULL, NULL, NULL, 1474427847, 1474963842, 1, 'Arjun', 'Paudel', NULL, '9841187158', 0, 3, 2, 'Siphal, Kathmandu', 'NP', 'apple123'),
(12, '::1', '', '$2y$08$XSIQn3jp2Y8cJGBfru./LOGCis6nWbqiGTXGm8wPxJy.39Yd3BGhi', '', 'this@that.com', NULL, NULL, NULL, '3F5YfO1V8gvT3DoOrECp8.', 1474785635, 1474785636, 1, 'This', 'That', NULL, '9841187158', 0, 0, 3, 'Balkhu, Kathmandu', 'NP', 'fireit01'),
(13, '::1', '', '$2y$08$Q9z9dw3VGdq./ANM18NKLuCaPgujjTcOYo7..1GX0mpkuANJIBrfi', '', 'waa@haa.com', NULL, NULL, NULL, '7lqxxStVQ75ugaj9cAVjju', 1474785876, 1474785876, 1, 'Waa', 'Haa', NULL, '9841187158', 0, 0, 3, 'Kalanki, Kathmandu', 'NP', 'fireit01');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 3),
(5, 5, 3),
(6, 6, 3),
(7, 7, 3),
(8, 8, 3),
(9, 9, 3),
(10, 10, 3),
(11, 11, 3),
(12, 12, 3),
(13, 13, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `do_sport`
--
ALTER TABLE `do_sport`
  ADD PRIMARY KEY (`customer_id`,`sportfacility_id`,`dosport_date`),
  ADD KEY `customer` (`customer_id`),
  ADD KEY `sport_facility` (`sportfacility_id`),
  ADD KEY `employee` (`employee_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `username` (`employee_username`),
  ADD UNIQUE KEY `email` (`employee_email`),
  ADD KEY `department` (`department_id`),
  ADD KEY `login` (`employee_username`,`employee_password`);

--
-- Indexes for table `get_medicalservice`
--
ALTER TABLE `get_medicalservice`
  ADD PRIMARY KEY (`customer_id`,`medicalservice_id`,`medicalservice_date`),
  ADD KEY `customer` (`customer_id`),
  ADD KEY `medical_service` (`medicalservice_id`),
  ADD KEY `employee` (`employee_id`);

--
-- Indexes for table `get_roomservice`
--
ALTER TABLE `get_roomservice`
  ADD PRIMARY KEY (`customer_id`,`roomservice_id`,`roomservice_date`),
  ADD KEY `customer` (`customer_id`),
  ADD KEY `room_service` (`roomservice_id`),
  ADD KEY `employee` (`employee_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry`
--
ALTER TABLE `laundry`
  ADD PRIMARY KEY (`laundry_id`);

--
-- Indexes for table `laundry_service`
--
ALTER TABLE `laundry_service`
  ADD PRIMARY KEY (`customer_id`,`laundry_id`),
  ADD KEY `customer` (`customer_id`),
  ADD KEY `laundry` (`laundry_id`),
  ADD KEY `employee` (`employee_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `massage_room`
--
ALTER TABLE `massage_room`
  ADD PRIMARY KEY (`massageroom_id`);

--
-- Indexes for table `massage_service`
--
ALTER TABLE `massage_service`
  ADD PRIMARY KEY (`customer_id`,`massageroom_id`),
  ADD KEY `customer` (`customer_id`),
  ADD KEY `massage` (`massageroom_id`),
  ADD KEY `employee` (`employee_id`);

--
-- Indexes for table `medical_service`
--
ALTER TABLE `medical_service`
  ADD PRIMARY KEY (`medicalservice_id`);

--
-- Indexes for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_r_name` (`restaurant_name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customer_id`),
  ADD KEY `employee` (`employee_id`),
  ADD KEY `room` (`room_id`),
  ADD KEY `availability` (`room_id`,`checkin_date`,`checkout_date`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`restaurant_name`);

--
-- Indexes for table `restaurant_booking`
--
ALTER TABLE `restaurant_booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant` (`restaurant_name`),
  ADD KEY `customer` (`customer_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `room_type` (`room_type`);

--
-- Indexes for table `room_sales`
--
ALTER TABLE `room_sales`
  ADD PRIMARY KEY (`customer_id`,`room_id`,`checkin_date`),
  ADD KEY `customer` (`customer_id`),
  ADD KEY `employee` (`employee_id`),
  ADD KEY `room` (`room_id`),
  ADD KEY `availability` (`room_id`,`checkin_date`,`checkout_date`);

--
-- Indexes for table `room_service`
--
ALTER TABLE `room_service`
  ADD PRIMARY KEY (`roomservice_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`room_type`);

--
-- Indexes for table `sport_facilities`
--
ALTER TABLE `sport_facilities`
  ADD PRIMARY KEY (`sportfacility_id`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transport_booking`
--
ALTER TABLE `transport_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `laundry`
--
ALTER TABLE `laundry`
  MODIFY `laundry_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `massage_room`
--
ALTER TABLE `massage_room`
  MODIFY `massageroom_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `medical_service`
--
ALTER TABLE `medical_service`
  MODIFY `medicalservice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `restaurant_booking`
--
ALTER TABLE `restaurant_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=411;
--
-- AUTO_INCREMENT for table `room_service`
--
ALTER TABLE `room_service`
  MODIFY `roomservice_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sport_facilities`
--
ALTER TABLE `sport_facilities`
  MODIFY `sportfacility_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transport_booking`
--
ALTER TABLE `transport_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `do_sport`
--
ALTER TABLE `do_sport`
  ADD CONSTRAINT `do_sport_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `do_sport_ibfk_2` FOREIGN KEY (`sportfacility_id`) REFERENCES `sport_facilities` (`sportfacility_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `do_sport_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `get_medicalservice`
--
ALTER TABLE `get_medicalservice`
  ADD CONSTRAINT `get_medicalservice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `get_medicalservice_ibfk_2` FOREIGN KEY (`medicalservice_id`) REFERENCES `medical_service` (`medicalservice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `get_medicalservice_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `get_roomservice`
--
ALTER TABLE `get_roomservice`
  ADD CONSTRAINT `get_roomservice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `get_roomservice_ibfk_2` FOREIGN KEY (`roomservice_id`) REFERENCES `room_service` (`roomservice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `get_roomservice_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laundry_service`
--
ALTER TABLE `laundry_service`
  ADD CONSTRAINT `laundry_service_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laundry_service_ibfk_2` FOREIGN KEY (`laundry_id`) REFERENCES `laundry` (`laundry_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laundry_service_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `massage_service`
--
ALTER TABLE `massage_service`
  ADD CONSTRAINT `massage_service_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `massage_service_ibfk_2` FOREIGN KEY (`massageroom_id`) REFERENCES `massage_room` (`massageroom_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `massage_service_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD CONSTRAINT `fk_r_name` FOREIGN KEY (`restaurant_name`) REFERENCES `restaurant` (`restaurant_name`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurant_booking`
--
ALTER TABLE `restaurant_booking`
  ADD CONSTRAINT `restaurant_booking_ibfk_1` FOREIGN KEY (`restaurant_name`) REFERENCES `restaurant` (`restaurant_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`room_type`) REFERENCES `room_type` (`room_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_sales`
--
ALTER TABLE `room_sales`
  ADD CONSTRAINT `room_sales_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room_sales_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room_sales_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

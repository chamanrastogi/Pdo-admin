-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2021 at 03:18 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `defence_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `parent_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `class` varchar(255) NOT NULL DEFAULT '',
  `position` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- Error reading data for table defence_new.menus: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `defence_new`.`menus`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE `menu_group` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`id`, `title`) VALUES
(1, 'Main Menu'),
(2, 'Quick Links'),
(3, 'Footer Menu');

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE `menu_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id`, `name`, `status`) VALUES
(1, 'Page', 'Active'),
(2, 'Url', 'Active'),
(3, 'External Page', 'Active'),
(4, 'Category', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `link` varchar(100) NOT NULL,
  `text` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `ftext` mediumtext NOT NULL,
  `status` enum('Active','Deactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `heading`, `link`, `text`, `image`, `ftext`, `status`) VALUES
(1, 'phone', 'phone', '', '00 000 123 456', '', '', 'Active'),
(2, 'email', 'email', '', 'info@identity_art.com', '', '', 'Active'),
(3, 'address', 'address', '', 'dolor sit amet, consectetur adipisicing elit', '', '', 'Active'),
(4, 'Home About', 'About Us', 'about-us', '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse minima distinctio facere velit provident? Beatae nulla magni nesciunt sed aut quam, vel dolor, officia sunt numquam deserunt, sequi fugiat libero Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse minima distinctio facere velit provident? Beatae nulla magni nesciunt sed aut quam, vel dolor, officia sunt numquam deserunt, sequi fugiat libero.</p>\r\n', 'Active'),
(5, 'Footer About us', 'About Us', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae delectus ipsa, ducimus, tempora corporis tenetur a illo perspiciatis. In obcaecati, hic ut at ipsam consequaturs.', 'boy_995459.png', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `mid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `keyword` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `text` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `mid`, `title`, `heading`, `keyword`, `description`, `image`, `text`) VALUES
(1, '1', 'About Us', 'About Us', '', '', 'aboutimg.png', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n'),
(3, '3', 'Private Policy', 'Private Policy', '', '', '', '<h3>Lorem ipsum dolor sit amet, consectetur</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<h3>Lorem ipsum dolor sit amet, consectetur</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<ul>\r\n	<li>deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus</li>\r\n	<li>praesentium, accusantium adipisicing elit. Ab atque r</li>\r\n	<li>praesentium, accusadipisicing elit. Ab atque</li>\r\n	<li>praesentium, accusantium sed adipisicing elit. Ab atque</li>\r\n</ul>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<ul>\r\n	<li>deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus</li>\r\n	<li>praesentium, accusantium adipisicing elit. Ab atque r</li>\r\n	<li>praesentium, accusadipisicing elit. Ab atque</li>\r\n	<li>praesentium, accusantium sed adipisicing elit. Ab atque</li>\r\n</ul>\r\n'),
(4, '4', 'Terms & Condition', 'Terms & Condition', '', '', '', '<h3>Lorem ipsum dolor sit amet, consectetur</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<h3>Lorem ipsum dolor sit amet, consectetur</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<ul>\r\n	<li>deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus</li>\r\n	<li>praesentium, accusantium adipisicing elit. Ab atque r</li>\r\n	<li>praesentium, accusadipisicing elit. Ab atque</li>\r\n	<li>praesentium, accusantium sed adipisicing elit. Ab atque</li>\r\n</ul>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque eos itaque fugiat magnam impedit nobis assumenda pariatur voluptas deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus reiciendis autem ea, accusantium dolorem temporibus perspiciatis repudiandae quam architecto aut, modi quibusdam.</p>\r\n\r\n<ul>\r\n	<li>deserunt, praesentium, accusantium sed error suscipit quod quos earum quas cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quod sit delectus expedita in similique ipsum doloribus</li>\r\n	<li>praesentium, accusantium adipisicing elit. Ab atque r</li>\r\n	<li>praesentium, accusadipisicing elit. Ab atque</li>\r\n	<li>praesentium, accusantium sed adipisicing elit. Ab atque</li>\r\n</ul>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  `status` enum('Active','Deactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `title`, `url`, `class`, `status`) VALUES
(1, 'Facebook', 'https://www.facebook.com/', 'facebook', 'Active'),
(2, 'Twitter', 'https://twitter.com/', 'twitter', 'Active'),
(3, 'Youtube', 'https://youtube.com/', 'youtube-play', 'Active'),
(4, 'Instagram', 'https://www.instagram.com/', 'instagram', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon_logo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `keyword` mediumtext NOT NULL,
  `ana` text NOT NULL,
  `footer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `sitename`, `logo`, `favicon_logo`, `email`, `description`, `keyword`, `ana`, `footer`) VALUES
(1, 'test Site', '', '', 'info@testsite.com', 'sdasd', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `post` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `text` mediumtext NOT NULL,
  `status` enum('Active','Deactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `adm_username` varchar(50) NOT NULL,
  `adm_password` varchar(100) NOT NULL,
  `adm_image` varchar(60) DEFAULT NULL,
  `adm_fullname` varchar(500) NOT NULL,
  `adm_email` varchar(50) NOT NULL,
  `adm_phone` varchar(20) NOT NULL,
  `role` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL,
  `status` varchar(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `adm_username`, `adm_password`, `adm_image`, `adm_fullname`, `adm_email`, `adm_phone`, `role`, `about`, `created`, `updated`, `status`) VALUES
(1, 'admin', '$2y$04$QltswFkmGuX.4DoBAroXRewuCpY.KEE/Snj3qeKD7APzkVY8566hG', 'profile-1.jpg', 'Ashish Rastogi', 'chaman@magicbytesolution.com', '797964645', 'admin', '', '2015-05-25 02:05:09', '0000-00-00 00:00:00', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu_group`
--
ALTER TABLE `menu_group`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

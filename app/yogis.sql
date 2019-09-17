-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2019 at 08:54 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yogis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccesslog`
--

CREATE TABLE IF NOT EXISTS `tblaccesslog` (
  `memberId` varchar(10) NOT NULL,
  `pageUrl` varchar(100) NOT NULL,
  `numVisits` bigint(20) NOT NULL,
  `lastAccess` datetime NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=233 ;

--
-- Dumping data for table `tblaccesslog`
--

INSERT INTO `tblaccesslog` (`memberId`, `pageUrl`, `numVisits`, `lastAccess`, `id`) VALUES
('1', 'mainMenu_m.php', 4, '2018-09-01 18:08:36', 131),
('1', 'mainMenu.php', 65, '2019-02-26 16:04:29', 121),
('752', 'registration_StudentRegistration.php', 25, '2018-09-20 18:01:22', 111),
('1', 'registration_StudentRegistration.php', 167, '2019-02-26 16:06:47', 101),
('752', 'mainMenu.php', 9, '2018-09-20 06:40:04', 91),
('1', 'logout.php', 2, '2018-09-20 06:30:50', 141),
('752', 'logout.php', 2, '2018-09-03 13:01:29', 151),
('1', 'changePassword.php', 1, '2018-09-03 13:14:30', 161),
('1', 'feeStructure_FeeMaster.php', 14, '2019-02-26 16:05:28', 201),
('1', 'admin_MenuStructure.php', 39, '2018-09-20 11:54:41', 181),
('1', 'admin_FileMaster.php', 13, '2018-09-20 06:24:02', 191),
('752', 'admin_FileAccessRights.php', 7, '2018-09-20 06:39:34', 211),
('752', 'feeStructure_FeeMaster.php', 16, '2018-09-20 18:02:34', 221),
('752', 'mainMenu_m.php', 1, '2018-09-20 17:54:04', 231),
('1', 'admin_UserCreation.php', 2, '2019-02-26 16:05:51', 232);

-- --------------------------------------------------------

--
-- Table structure for table `tbldancecategory`
--

CREATE TABLE IF NOT EXISTS `tbldancecategory` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `categoryname` varchar(200) NOT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbldancecategory`
--

INSERT INTO `tbldancecategory` (`categoryid`, `groupid`, `categoryname`) VALUES
(1, 1, 'Hip Hop'),
(2, 1, 'Locking Popping'),
(3, 1, 'Urban '),
(4, 1, 'Krumping'),
(5, 1, 'B Boy'),
(6, 1, 'Contemporary '),
(7, 1, 'Salsa'),
(8, 2, 'Bollywood'),
(9, 2, 'Folk'),
(10, 3, 'Dancercise (5 to 6 pm Mon to Friday - Above 18 Yrs Only)');

-- --------------------------------------------------------

--
-- Table structure for table `tbldancegroup`
--

CREATE TABLE IF NOT EXISTS `tbldancegroup` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbldancegroup`
--

INSERT INTO `tbldancegroup` (`groupid`, `description`) VALUES
(1, 'Western Dance'),
(2, 'Semi classical'),
(3, 'Dancercise');

-- --------------------------------------------------------

--
-- Table structure for table `tbldancepackage`
--

CREATE TABLE IF NOT EXISTS `tbldancepackage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbldancepackage`
--

INSERT INTO `tbldancepackage` (`id`, `package`) VALUES
(1, 'Monthly'),
(2, 'Months'),
(3, 'One Year');

-- --------------------------------------------------------

--
-- Table structure for table `tblfeestructure`
--

CREATE TABLE IF NOT EXISTS `tblfeestructure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(500) NOT NULL,
  `packageid` int(11) NOT NULL,
  `fee` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `description` (`description`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tblfeestructure`
--

INSERT INTO `tblfeestructure` (`id`, `description`, `packageid`, `fee`, `status`) VALUES
(2, '3  to 6 yrs', 1, 500, 'Active'),
(3, '7 to 10 yrs', 1, 1500, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblfileaccessrights`
--

CREATE TABLE IF NOT EXISTS `tblfileaccessrights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `access` varchar(3) NOT NULL,
  `note` varchar(500) NOT NULL,
  `medit` varchar(10) NOT NULL,
  `madd` varchar(10) NOT NULL,
  `mdelete` varchar(10) NOT NULL,
  `mview` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`,`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `tblfileaccessrights`
--

INSERT INTO `tblfileaccessrights` (`id`, `uid`, `fid`, `access`, `note`, `medit`, `madd`, `mdelete`, `mview`) VALUES
(1, 1, 16, 'Yes', '', 'Yes', 'Yes', 'No', ''),
(2, 1, 17, 'Yes', '', 'Yes', 'Yes', 'No', ''),
(3, 1, 23, 'Yes', '', 'Yes', 'Yes', 'No', ''),
(4, 1, 50, 'Yes', '', 'Yes', 'Yes', 'No', ''),
(5, 1, 114, 'Yes', '', 'Yes', 'Yes', 'No', ''),
(6, 1, 150, 'Yes', '', 'Yes', 'Yes', 'No', ''),
(7, 1, 151, 'Yes', '', '', '', '', ''),
(8, 1, 158, 'Yes', '', '', '', '', ''),
(9, 1, 741, 'Yes', '', 'Yes', 'Yes', 'No', ''),
(11, 752, 16, 'Yes', '', 'Yes', 'Yes', 'No', 'Yes'),
(12, 752, 23, 'Yes', '', 'Yes', 'Yes', 'No', 'Yes'),
(15, 752, 151, 'Yes', '', '', '', '', ''),
(16, 752, 17, 'Yes', '', 'Yes', 'Yes', 'No', ''),
(17, 752, 50, 'Yes', '', 'Yes', 'Yes', 'No', ''),
(18, 752, 114, 'Yes', '', 'Yes', 'Yes', 'No', ''),
(19, 752, 150, 'Yes', '', 'Yes', 'Yes', 'No', ''),
(20, 752, 741, 'Yes', '', 'Yes', 'Yes', 'No', ''),
(21, 1, 919, 'Yes', '', '', '', '', ''),
(22, 1, 920, 'Yes', '', '', '', '', ''),
(23, 1, 921, 'Yes', '', 'Yes', 'Yes', 'No', ''),
(24, 752, 921, 'Yes', '', 'Yes', 'Yes', 'No', 'Yes'),
(31, 752, 919, 'Yes', '', '', '', '', ''),
(41, 1, 931, 'Yes', '', '', '', '', ''),
(51, 752, 931, 'Yes', '', 'Yes', 'Yes', '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tblfilemaster`
--

CREATE TABLE IF NOT EXISTS `tblfilemaster` (
  `fileid` int(11) NOT NULL AUTO_INCREMENT,
  `displayname` varchar(200) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `note` varchar(500) NOT NULL,
  `mainmenu` int(11) NOT NULL,
  `secondmenuid` int(11) NOT NULL,
  `isinternal` varchar(3) NOT NULL,
  `madd` varchar(3) NOT NULL DEFAULT 'No',
  `medit` varchar(3) NOT NULL DEFAULT 'No',
  `displayorder` int(11) NOT NULL,
  `entrytype` varchar(10) NOT NULL,
  `needpopup` varchar(3) NOT NULL DEFAULT 'No',
  `accesslog` int(11) NOT NULL DEFAULT '1',
  `tooltipposition` varchar(10) NOT NULL DEFAULT 'right',
  `new_name` varchar(200) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`fileid`),
  UNIQUE KEY `filename` (`filename`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=932 ;

--
-- Dumping data for table `tblfilemaster`
--

INSERT INTO `tblfilemaster` (`fileid`, `displayname`, `filename`, `note`, `mainmenu`, `secondmenuid`, `isinternal`, `madd`, `medit`, `displayorder`, `entrytype`, `needpopup`, `accesslog`, `tooltipposition`, `new_name`, `status`) VALUES
(16, 'Home', 'mainMenu.php', 'Main display window.', 1, 1, 'No', 'No', 'No', 0, 'Normal', 'No', 0, 'right', 'home_LandingPage.php', 'Active'),
(17, 'Create User', 'admin_UserCreation.php', 'Create new users for php interface access. Also sends auto email to the new user.', 3, 122, 'No', 'Yes', 'No', 0, 'Normal', 'No', 1, 'right', 'home_UserCreation.php', 'Active'),
(23, 'Change Password', 'changePassword.php', 'Change your php interface password.', 1, 11, 'No', 'No', 'Yes', 0, 'Normal', 'No', 1, 'right', 'home_ChangeRmtPassword.php', 'Active'),
(50, 'Master File Maintenance', 'admin_FileMaster.php', 'Manages php files. Access restricted to IT personnel.', 3, 22, 'No', 'Yes', 'Yes', 2, 'Normal', 'No', 1, 'right', '', 'Active'),
(114, 'Manage Access Rights', 'admin_FileAccessRights.php', 'Manages user access right to the php module and forms. Access restricted to IT personnel only.', 3, 22, 'No', 'Yes', 'Yes', 3, 'Normal', 'No', 1, 'right', '', 'Active'),
(150, 'Menu Structure', 'admin_MenuStructure.php', 'Allows to input new menu and sub menu. Access restricted IT personnel only. ', 3, 22, 'No', 'No', 'No', 1, 'Normal', 'No', 1, 'right', '', 'Active'),
(151, 'Logout', 'logout.php', 'Logs out from this php interface.', 1, 19, 'No', 'No', 'No', 6, 'Normal', 'No', 0, 'right', 'home_LogOut.php', 'Active'),
(158, 'Login', 'login', '', 1, 0, 'Yes', 'No', 'No', 1, 'Normal', 'No', 1, 'right', 'home_LogIn.php', 'Active'),
(741, 'Mobile access', 'mhvMenu_m.php', 'Mobile access', 3, 83, 'No', 'No', 'No', 0, 'Normal', 'No', 1, 'right', '', 'Active'),
(919, 'New', 'mainMenu_m.php', '', 0, 0, '', 'No', 'No', 0, '', 'No', 1, 'right', '', 'Active'),
(921, 'Enrollment', 'registration_StudentRegistration.php', 'Add/Edit student record.', 2, 12, 'No', 'No', 'No', 0, 'New', 'No', 1, 'right', '', 'Active'),
(931, 'Fee Structure', 'feeStructure_FeeMaster.php', 'Fee Structure', 21, 131, 'No', 'No', 'No', 0, 'New', 'No', 1, 'right', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblmonth`
--

CREATE TABLE IF NOT EXISTS `tblmonth` (
  `monthno` int(11) NOT NULL,
  `status` varchar(2) NOT NULL,
  `mname` varchar(3) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `myear` int(11) NOT NULL,
  `currmonth` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `monthno` (`monthno`,`myear`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=172 ;

--
-- Dumping data for table `tblmonth`
--

INSERT INTO `tblmonth` (`monthno`, `status`, `mname`, `id`, `myear`, `currmonth`) VALUES
(1, '0', 'Jan', 4, 2014, 0),
(2, '0', 'Feb', 5, 2014, 0),
(3, '0', 'Mar', 6, 2014, 0),
(4, '0', 'Apr', 7, 2014, 0),
(5, '0', 'May', 8, 2014, 0),
(6, '0', 'Jun', 9, 2014, 0),
(7, '0', 'Jul', 10, 2014, 0),
(8, '0', 'Aug', 11, 2014, 0),
(9, '0', 'Sep', 12, 2014, 0),
(10, '0', 'Oct', 13, 2014, 0),
(11, '0', 'Nov', 14, 2014, 0),
(12, '0', 'Dec', 15, 2014, 0),
(1, '0', 'Jan', 16, 2015, 0),
(2, '0', 'Feb', 17, 2015, 0),
(3, '0', 'Mar', 18, 2015, 0),
(4, '0', 'Apr', 19, 2015, 0),
(5, '0', 'May', 20, 2015, 0),
(6, '0', 'Jun', 21, 2015, 0),
(7, '0', 'Jul', 22, 2015, 0),
(8, '0', 'Aug', 23, 2015, 0),
(9, '0', 'Sep', 24, 2015, 0),
(10, '0', 'Oct', 25, 2015, 0),
(11, '0', 'Nov', 26, 2015, 0),
(12, '0', 'Dec', 27, 2015, 0),
(1, '0', 'Jan', 28, 2016, 0),
(2, '0', 'Feb', 29, 2016, 0),
(3, '0', 'Mar', 30, 2016, 0),
(4, '0', 'Apr', 31, 2016, 0),
(5, '0', 'May', 32, 2016, 0),
(6, '0', 'Jun', 33, 2016, 0),
(7, '0', 'Jul', 34, 2016, 0),
(8, '0', 'Aug', 36, 2016, 0),
(9, '0', 'Sep', 37, 2016, 0),
(10, '0', 'Oct', 38, 2016, 0),
(11, '0', 'Nov', 39, 2016, 0),
(12, '0', 'Dec', 40, 2016, 0),
(1, '0', 'Jan', 41, 2017, 0),
(2, '0', 'Feb', 42, 2017, 0),
(3, '0', 'Mar', 43, 2017, 0),
(4, '0', 'Apr', 44, 2017, 0),
(5, '0', 'May', 45, 2017, 0),
(6, '0', 'Jun', 46, 2017, 0),
(7, '0', 'Jul', 47, 2017, 0),
(8, '0', 'Aug', 48, 2017, 0),
(9, '0', 'Sep', 49, 2017, 0),
(10, '0', 'Oct', 50, 2017, 0),
(11, '0', 'Nov', 51, 2017, 0),
(12, '0', 'Dec', 52, 2017, 0),
(1, '0', 'Jan', 53, 2013, 1),
(1, '0', 'Jan', 54, 2012, 0),
(1, '0', 'Jan', 55, 2011, 0),
(1, '0', 'Jan', 56, 2010, 0),
(1, '0', 'Jan', 61, 2018, 0),
(2, '0', 'Feb', 71, 2018, 0),
(3, '0', 'Mar', 81, 2018, 0),
(4, '0', 'Apr', 91, 2018, 0),
(5, '0', 'May', 101, 2018, 0),
(6, '0', 'Jun', 111, 2018, 0),
(7, '1', 'Jul', 121, 2018, 0),
(8, '0', 'Aug', 131, 2018, 1),
(9, '0', 'Sep', 141, 2018, 0),
(10, '0', 'Oct', 151, 2018, 0),
(11, '0', 'Nov', 161, 2018, 0),
(12, '0', 'Dec', 171, 2018, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblphpaccesslog`
--

CREATE TABLE IF NOT EXISTS `tblphpaccesslog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pagename` varchar(200) NOT NULL,
  `mdate` datetime NOT NULL,
  `sessionid` varchar(767) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`,`pagename`,`sessionid`),
  KEY `uid_2` (`uid`,`pagename`,`mdate`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2269 ;

--
-- Dumping data for table `tblphpaccesslog`
--

INSERT INTO `tblphpaccesslog` (`id`, `uid`, `pagename`, `mdate`, `sessionid`) VALUES
(1, 1, 'mainMenu.php', '2018-09-03 10:42:56', 'h3mdkdci526lsmdcil2hd7j3c1'),
(11, 1, 'logout.php', '2018-09-03 10:42:58', 'h3mdkdci526lsmdcil2hd7j3c1'),
(21, 752, 'mainMenu.php', '2018-09-03 10:43:08', '85bo54688m99i7se8nau0dpjo7'),
(31, 752, 'logout.php', '2018-09-03 10:43:19', '85bo54688m99i7se8nau0dpjo7'),
(41, 752, 'mainMenu.php', '2018-09-03 10:45:19', '6qoif6cffgaeg1abprcql7if04'),
(51, 752, 'registration_StudentRegistration.php', '2018-09-03 10:46:04', '6qoif6cffgaeg1abprcql7if04'),
(111, 1, 'mainMenu.php', '2018-09-03 11:03:08', 'lc8i384krv0cern66kgtvdef01'),
(121, 1, 'registration_StudentRegistration.php', '2018-09-03 11:03:12', 'lc8i384krv0cern66kgtvdef01'),
(211, 752, 'logout.php', '2018-09-03 13:01:29', '6qoif6cffgaeg1abprcql7if04'),
(221, 1, 'mainMenu.php', '2018-09-03 13:10:54', 'sbeqba8dl782q1pdvi9rlqerk5'),
(231, 1, 'registration_StudentRegistration.php', '2018-09-03 13:10:54', 'sbeqba8dl782q1pdvi9rlqerk5'),
(251, 1, 'changePassword.php', '2018-09-03 13:14:30', 'sbeqba8dl782q1pdvi9rlqerk5'),
(301, 1, 'mainMenu.php', '2018-09-03 16:44:31', 'trarekoui04o52cojghivejim5'),
(311, 1, 'registration_StudentRegistration.php', '2018-09-03 16:44:34', 'trarekoui04o52cojghivejim5'),
(321, 1, 'mainmenu.php', '2018-09-04 04:00:52', 'o439namfi9rb6k8badqkhmgm54'),
(331, 1, 'registration_StudentRegistration.php', '2018-09-04 04:00:59', 'o439namfi9rb6k8badqkhmgm54'),
(341, 1, 'mainMenu.php', '2018-09-04 18:55:51', 'g4sjus7635ef0cpf4n5upskas6'),
(351, 1, 'registration_StudentRegistration.php', '2018-09-04 18:55:54', 'g4sjus7635ef0cpf4n5upskas6'),
(371, 1, 'mainMenu.php', '2018-09-04 18:56:39', 'n20oi2jq09ukbre0qqc7ca5us1'),
(381, 1, 'registration_StudentRegistration.php', '2018-09-04 18:56:44', 'n20oi2jq09ukbre0qqc7ca5us1'),
(401, 1, 'mainMenu.php', '2018-09-04 19:02:05', '72kdvfk5p980r6rs1lhcu2q5b6'),
(411, 1, 'registration_StudentRegistration.php', '2018-09-04 19:02:06', '72kdvfk5p980r6rs1lhcu2q5b6'),
(551, 1, 'mainMenu.php', '2018-09-04 21:51:50', 'tubbg1q9drt6i3gj7osehfqj05'),
(561, 1, 'registration_StudentRegistration.php', '2018-09-04 21:51:50', 'tubbg1q9drt6i3gj7osehfqj05'),
(571, 1, 'registration_StudentRegistration.php', '2018-09-05 07:19:21', '2n1o331cg262mjhhr27859od90'),
(581, 752, 'mainMenu.php', '2018-09-19 09:09:10', 'ertqf6jql8vrquora1gogup4l4'),
(591, 1, 'mainMenu.php', '2018-09-20 00:29:29', '7rrm1qnpnmas9cbl8v0ma4fup1'),
(611, 1, 'registration_StudentRegistration.php', '2018-09-20 00:29:47', '7rrm1qnpnmas9cbl8v0ma4fup1'),
(631, 1, 'mainMenu.php', '2018-09-20 00:31:24', 'brfrebucr949tkl5phnihsj5e5'),
(671, 1, 'registration_StudentRegistration.php', '2018-09-20 00:34:45', 'brfrebucr949tkl5phnihsj5e5'),
(691, 1, 'mainMenu.php', '2018-09-20 00:50:25', 'jqrn9ig6un43uh5f7gd53qf7b0'),
(701, 1, 'registration_StudentRegistration.php', '2018-09-20 00:50:26', 'jqrn9ig6un43uh5f7gd53qf7b0'),
(721, 1, 'mainMenu.php', '2018-09-20 00:51:25', 'jj30u6e0mkr0b05sbg7ld5jmi3'),
(731, 1, 'registration_StudentRegistration.php', '2018-09-20 00:51:27', 'jj30u6e0mkr0b05sbg7ld5jmi3'),
(751, 1, 'mainMenu.php', '2018-09-20 00:53:23', '5p6eatlvsc8f427iqd0sdat8p0'),
(771, 1, 'registration_StudentRegistration.php', '2018-09-20 00:53:33', '5p6eatlvsc8f427iqd0sdat8p0'),
(791, 1, 'mainMenu.php', '2018-09-20 01:09:43', 'ql52duha2q1v5ukg9itv6lqh44'),
(801, 1, 'registration_StudentRegistration.php', '2018-09-20 01:09:44', 'ql52duha2q1v5ukg9itv6lqh44'),
(811, 1, 'mainMenu.php', '2018-09-20 06:02:57', 'ipo54l93o9ov0s3fc0l01tpe31'),
(821, 1, 'registration_StudentRegistration.php', '2018-09-20 06:03:01', 'ipo54l93o9ov0s3fc0l01tpe31'),
(1051, 1, 'feeStructure_FeeMaster.php', '2018-09-20 06:21:02', 'ipo54l93o9ov0s3fc0l01tpe31'),
(1071, 1, 'admin_MenuStructure.php', '2018-09-20 06:21:08', 'ipo54l93o9ov0s3fc0l01tpe31'),
(1181, 1, 'admin_FileMaster.php', '2018-09-20 06:21:52', 'ipo54l93o9ov0s3fc0l01tpe31'),
(1461, 1, 'mainMenu.php', '2018-09-20 06:30:47', 'vemrilau8h35nocc05qjgvvj26'),
(1471, 1, 'logout.php', '2018-09-20 06:30:50', 'vemrilau8h35nocc05qjgvvj26'),
(1481, 752, 'mainMenu.php', '2018-09-20 06:31:04', 'cj6c26dlhu6opvkboou8ia2e20'),
(1511, 752, 'admin_FileAccessRights.php', '2018-09-20 06:39:20', 'cj6c26dlhu6opvkboou8ia2e20'),
(1591, 752, 'registration_StudentRegistration.php', '2018-09-20 06:39:42', 'cj6c26dlhu6opvkboou8ia2e20'),
(1611, 752, 'feeStructure_FeeMaster.php', '2018-09-20 06:39:48', 'cj6c26dlhu6opvkboou8ia2e20'),
(1621, 1, 'mainMenu.php', '2018-09-20 11:46:44', 'cmh1fup1negmn7vm8v9r5ab4e1'),
(1631, 1, 'registration_StudentRegistration.php', '2018-09-20 11:46:47', 'cmh1fup1negmn7vm8v9r5ab4e1'),
(1691, 1, 'feeStructure_FeeMaster.php', '2018-09-20 11:47:48', 'cmh1fup1negmn7vm8v9r5ab4e1'),
(1721, 1, 'admin_MenuStructure.php', '2018-09-20 11:48:36', 'cmh1fup1negmn7vm8v9r5ab4e1'),
(2051, 752, 'mainMenu_m.php', '2018-09-20 17:54:04', '0p5b2l0ilduk0tvtfe3uocsj01'),
(2061, 752, 'registration_StudentRegistration.php', '2018-09-20 17:54:35', '0p5b2l0ilduk0tvtfe3uocsj01'),
(2081, 752, 'feeStructure_FeeMaster.php', '2018-09-20 17:55:03', '0p5b2l0ilduk0tvtfe3uocsj01'),
(2101, 1, 'mainMenu.php', '2018-09-20 17:55:08', 'qs5a7r8mld92vci882r7j9g2c0'),
(2111, 1, 'registration_StudentRegistration.php', '2018-09-20 17:55:40', 'qs5a7r8mld92vci882r7j9g2c0'),
(2251, 1, 'feeStructure_FeeMaster.php', '2018-09-20 17:59:38', 'qs5a7r8mld92vci882r7j9g2c0'),
(2261, 1, 'mainMenu.php', '2018-09-22 09:30:52', '330pant7aajpfl9cshlnf2t2k6'),
(2262, 1, 'mainMenu.php', '2019-02-26 16:03:19', 'vkltaq7jtsd22hah8nlgjvtia3'),
(2263, 1, 'mainMenu.php', '2019-02-26 16:04:29', '3vjpkmgpf0l9vd8mcpoqpaeq65'),
(2264, 1, 'registration_StudentRegistration.php', '2019-02-26 16:04:39', '3vjpkmgpf0l9vd8mcpoqpaeq65'),
(2266, 1, 'feeStructure_FeeMaster.php', '2019-02-26 16:05:26', '3vjpkmgpf0l9vd8mcpoqpaeq65'),
(2268, 1, 'admin_UserCreation.php', '2019-02-26 16:05:50', '3vjpkmgpf0l9vd8mcpoqpaeq65');

-- --------------------------------------------------------

--
-- Table structure for table `tblsecondlevelmenu`
--

CREATE TABLE IF NOT EXISTS `tblsecondlevelmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topmenuid` int(11) NOT NULL,
  `menuname` varchar(200) NOT NULL,
  `hassubmenu` varchar(3) NOT NULL DEFAULT 'Yes',
  `note` varchar(5000) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `isactive` varchar(3) NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;

--
-- Dumping data for table `tblsecondlevelmenu`
--

INSERT INTO `tblsecondlevelmenu` (`id`, `topmenuid`, `menuname`, `hassubmenu`, `note`, `displayorder`, `isactive`) VALUES
(1, 1, 'Home', 'No', '', 1, 'Yes'),
(11, 1, 'Change Password', 'No', '', 3, 'Yes'),
(12, 2, 'Student Registartion', 'Yes', '', 1, 'Yes'),
(17, 1, 'Change File Manager Password', 'No', '', 4, 'No'),
(18, 1, 'Check Your Accessable Form', 'No', '', 5, 'No'),
(19, 1, 'Logout', 'No', '', 6, 'Yes'),
(22, 3, 'Application Menu Management', 'Yes', '', 4, 'Yes'),
(122, 3, 'Users Management', 'Yes', '', 2, 'Yes'),
(131, 21, 'Fee Structure', 'Yes', '', 0, 'Yes'),
(141, 31, 'Income & Expenditure ', 'Yes', '', 0, 'Yes'),
(151, 41, 'Income & Expendeture', 'Yes', '', 0, 'Yes'),
(161, 41, 'Student', 'Yes', '', 1, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentregistration`
--

CREATE TABLE IF NOT EXISTS `tblstudentregistration` (
  `studentcode` int(11) NOT NULL AUTO_INCREMENT,
  `studentname` varchar(200) NOT NULL,
  `dateofbirth` date NOT NULL,
  `birthcertdoclocation` varchar(500) NOT NULL,
  `birthcertdocfiletype` varchar(10) NOT NULL,
  `medicalcondition` text NOT NULL,
  `mothername` varchar(200) NOT NULL,
  `fathername` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `phoneemergency` varchar(15) NOT NULL,
  `package` int(11) NOT NULL,
  `regdatefrom` date NOT NULL,
  `regdateto` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `updatedby` varchar(100) NOT NULL,
  `updatedon` datetime NOT NULL,
  `studentimagelocation` varchar(500) NOT NULL,
  `studentimagefiletype` varchar(10) NOT NULL,
  `dancecategory` text NOT NULL,
  PRIMARY KEY (`studentcode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20180003 ;

--
-- Dumping data for table `tblstudentregistration`
--

INSERT INTO `tblstudentregistration` (`studentcode`, `studentname`, `dateofbirth`, `birthcertdoclocation`, `birthcertdocfiletype`, `medicalcondition`, `mothername`, `fathername`, `address`, `phone`, `phoneemergency`, `package`, `regdatefrom`, `regdateto`, `status`, `updatedby`, `updatedon`, `studentimagelocation`, `studentimagefiletype`, `dancecategory`) VALUES
(20180001, 'RYHAAN', '2018-09-18', '', '', 'NORMAL', 'GEETA GIRI', 'DILU GIRI', 'NS ROAD JAIGAON', '77207878', '77207878', 3, '2018-09-01', '2018-09-20', 'Active', 'mukti', '2018-09-20 11:47:23', '', '', '1'),
(20180002, 'Sahil Lama', '2018-09-21', '', '', 'all ok', 'prasana lama ', 'pradip lama', 'jaigaon ', '8001215156', '77207878', 2, '2018-09-05', '2018-09-04', 'Active', 'mukti', '2018-09-20 11:47:34', 'studentImages/20180002.jpg', 'jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbltopmenu`
--

CREATE TABLE IF NOT EXISTS `tbltopmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menuname` varchar(200) NOT NULL,
  `note` varchar(5000) NOT NULL,
  `displayorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `tbltopmenu`
--

INSERT INTO `tbltopmenu` (`id`, `menuname`, `note`, `displayorder`) VALUES
(1, 'Menu', '', 1),
(2, 'Registration', '', 3),
(3, 'Admin', '', 2),
(4, 'Events', '', 4),
(14, 'Classes', '', 5),
(21, 'Fee Structure', '', 6),
(31, 'Transaction', '', 7),
(41, 'Report', '', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `staffname` varchar(100) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `isdefaultpasswordreset` enum('No','Yes') NOT NULL DEFAULT 'No',
  `updatedby` varchar(100) NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=756 ;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `username`, `password`, `staffname`, `emailid`, `status`, `isdefaultpasswordreset`, `updatedby`, `updatedon`) VALUES
(1, 'mukti', 'd4eeabf87781ac71f185e203cfdc26f3', 'Mukti Nath Chhetri', 'muktitcc@gmail.com', 'Active', 'Yes', 'mukti', '2018-09-01 08:07:17'),
(752, 'dilu', '9d8fe7dcf9e92359b71fee78942c2a51', 'Dilu Giri', 'dilu.giri@drukhotels.com', 'Active', 'Yes', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser_resetpassword`
--

CREATE TABLE IF NOT EXISTS `tbluser_resetpassword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `requesteddate` datetime NOT NULL,
  `midentification` varchar(1000) NOT NULL,
  `isprocessed` varchar(3) NOT NULL DEFAULT 'No',
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=173 ;

--
-- Dumping data for table `tbluser_resetpassword`
--

INSERT INTO `tbluser_resetpassword` (`id`, `userid`, `username`, `requesteddate`, `midentification`, `isprocessed`, `email`) VALUES
(172, 1, 'mukti', '2018-08-31 22:35:01', 'a5bUbKEHX9YJs6eesrB4Ua0EI4+6kVarTUvLtw1zirY=', 'No', 'muktitcc@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

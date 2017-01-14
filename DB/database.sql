-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2017 at 08:28 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exclusiveunlock`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_configurations`
--

CREATE TABLE `app_configurations` (
  `ApplicationName` varchar(255) DEFAULT NULL,
  `ApplicationURL` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `AnalyticsCode` text,
  `FaceBook` varchar(255) DEFAULT NULL,
  `Twitter` varchar(255) DEFAULT NULL,
  `LinkedIn` varchar(255) DEFAULT NULL,
  `GooglePlus` varchar(255) DEFAULT NULL,
  `Skype` varchar(50) DEFAULT NULL,
  `CallUs` varchar(50) DEFAULT NULL,
  `CurrencyCode` varchar(5) DEFAULT NULL,
  `Status` enum('Offline','Online') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_configurations`
--

INSERT INTO `app_configurations` (`ApplicationName`, `ApplicationURL`, `Email`, `AnalyticsCode`, `FaceBook`, `Twitter`, `LinkedIn`, `GooglePlus`, `Skype`, `CallUs`, `CurrencyCode`, `Status`) VALUES
('Exclusiveunlock', 'http://www.exclusiveunlock.co.uk', 'shariq@ibussolutions.com', '', 'http://facebook.com', 'http://twitter.com', 'http://linkedin.com', 'http://google.com', 'exclusiveunlock', '11-115454-45', 'GBP', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `cms_autoresponders`
--

CREATE TABLE `cms_autoresponders` (
  `ID` int(11) NOT NULL,
  `Title` varchar(225) NOT NULL,
  `FromEmail` varchar(255) DEFAULT NULL,
  `FromName` varchar(255) DEFAULT NULL,
  `ToEmail` varchar(255) DEFAULT NULL,
  `Subject` varchar(255) DEFAULT NULL,
  `Message` text,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `Status` enum('Disabled','Enabled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_autoresponders`
--

INSERT INTO `cms_autoresponders` (`ID`, `Title`, `FromEmail`, `FromName`, `ToEmail`, `Subject`, `Message`, `UpdatedDateTime`, `CreatedDateTime`, `Status`) VALUES
(1, 'Registration', 'info@exclusiveunlock.co.uk', 'Exclusive Unlock', '[Email]', 'ExclusiveUnlock: Thank your for registration', '&lt;p&gt;Dear [FirstName] [LastName],&lt;br /&gt;\r\nThank you for registration&lt;/p&gt;\r\n\r\n&lt;p&gt;Email: [Email]&lt;br /&gt;\r\nPassword: [Password]&lt;/p&gt;\r\n\r\n&lt;p&gt;Regards,&lt;br /&gt;\r\nExclusiveunlock.co.uk&lt;/p&gt;\r\n', '2015-12-11 06:58:05', '2016-01-01 00:00:00', 'Enabled'),
(2, 'IMEI Code Canceled', 'info@exclusiveunlock.co.uk', 'Exclusive Unlock', '[Email]', 'ExclusiveUnlock: IMEI Code Canceled', '&lt;p&gt;Dear [FirstName] [LastName],&lt;br /&gt;\r\nWe are very sorry, we had to cancel your code request, a refund is also issued for the credits used. Below is a quick summary of your request.&lt;/p&gt;\r\n\r\n&lt;p&gt;IMEI: [IMEI]&lt;br /&gt;\r\nCode: [Code]&lt;br /&gt;\r\nStatus: Refunded&lt;/p&gt;\r\n\r\n&lt;p&gt;Please login to your account to view all your requests.&lt;/p&gt;\r\n\r\n&lt;p&gt;Regards,&lt;br /&gt;\r\nExclusiveunlock.co.uk&lt;/p&gt;\r\n', '2015-12-11 07:03:29', '2016-01-01 00:00:00', 'Enabled'),
(3, 'IMEI Code Issue', 'info@exclusiveunlock.co.uk', 'Exclusive Unlock', '[Email]', 'ExclusiveUnlock: IMEI Code Issued', '&lt;p&gt;Dear [FirstName] [LastName],&lt;br /&gt;\r\nWe have just issued you the Unlock code you have requested, below is a quick summary of your request with the code.&lt;/p&gt;\r\n\r\n&lt;p&gt;IMEI: [IMEI]&lt;br /&gt;\r\nCode: [Code]&lt;br /&gt;\r\nStatus: SUCCESS&lt;/p&gt;\r\n\r\n&lt;p&gt;Please login to your account to view all your requests.&lt;/p&gt;\r\n\r\n&lt;p&gt;Regards,&lt;br /&gt;\r\nExclusiveunlock.co.uk&lt;/p&gt;\r\n', '2015-12-11 07:04:35', '2016-01-01 00:00:00', 'Enabled'),
(4, 'Forgot Password Token Email', 'info@exclusiveunlock.co.uk', 'Exclusive Unlock', '[Email]', 'ExclusiveUnlock: Password Recovery', '&lt;p&gt;Dear [FirstName] [LastName],&lt;br /&gt;\r\nWe have just received your forgot password request, below is the confirmation link to reset your password.&lt;/p&gt;\r\n\r\n&lt;p&gt;Confirmation Link: &lt;a href="[TOKEN_URL]"&gt;[TOKEN_URL]&lt;/a&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;If you did not request to reset the password, Just ignore this email.&lt;/p&gt;\r\n\r\n&lt;p&gt;Regards,&lt;br /&gt;\r\nExclusiveunlock.co.uk&lt;/p&gt;\r\n', '2015-12-11 07:09:47', '2016-01-01 00:00:00', 'Enabled'),
(5, 'Forgot Password Reset', 'info@exclusiveunlock.co.uk', 'Exclusive Unlock', '[Email]', 'ExclusiveUnlock: Password Recovery', '&lt;p&gt;Dear [FirstName] [LastName],&lt;br /&gt;\r\nYour account password has been reset upon your request. Below are your new credentials for login into your account&lt;/p&gt;\r\n\r\n&lt;p&gt;Email: [Email]&lt;br /&gt;\r\nPassword: [Password]&lt;/p&gt;\r\n\r\n&lt;p&gt;Please change your password after login.&lt;/p&gt;\r\n\r\n&lt;p&gt;Regards,&lt;br /&gt;\r\nExclusiveunlock.co.uk&lt;/p&gt;\r\n', '2015-12-11 07:12:59', '2016-01-01 00:00:00', 'Enabled'),
(6, 'File Code Canceled', 'info@exclusiveunlock.co.uk', 'Exclusive Unlock', '[Email]', 'ExclusiveUnlock: File Code Canceled', '&lt;p&gt;Dear [FirstName] [LastName],&lt;br /&gt;\r\nWe are very sorry, we had to cancel your code request, a refund is also issued for the credits used. Below is a quick summary of your request.&lt;/p&gt;\r\n\r\n&lt;p&gt;IMEI: [IMEI]&lt;br /&gt;\r\nCode: [Code]&lt;br /&gt;\r\nStatus: Refunded&lt;/p&gt;\r\n\r\n&lt;p&gt;Please login to your account to view all your requests.&lt;/p&gt;\r\n\r\n&lt;p&gt;Regards,&lt;br /&gt;\r\nExclusiveunlock.co.uk&lt;/p&gt;\r\n', '2015-12-11 07:03:29', '2016-01-01 00:00:00', 'Enabled'),
(7, 'File Code Issue', 'info@exclusiveunlock.co.uk', 'Exclusive Unlock', '[Email]', 'ExclusiveUnlock: File Code Issued', '&lt;p&gt;Dear [FirstName] [LastName],&lt;br /&gt;\r\nWe have just issued you the Unlock code you have requested, below is a quick summary of your request with the code.&lt;/p&gt;\r\n\r\n&lt;p&gt;IMEI: [IMEI]&lt;br /&gt;\r\nCode: [Code]&lt;br /&gt;\r\nStatus: SUCCESS&lt;/p&gt;\r\n\r\n&lt;p&gt;Please login to your account to view all your requests.&lt;/p&gt;\r\n\r\n&lt;p&gt;Regards,&lt;br /&gt;\r\nExclusiveunlock.co.uk&lt;/p&gt;\r\n', '2015-12-11 07:04:35', '2016-01-01 00:00:00', 'Enabled'),
(8, 'DUMMY', 'info@exclusiveunlock.co.uk', 'Exclusive Unlock', '[Email]', 'DUMMY', NULL, '2016-01-01 00:00:00', '2016-01-01 00:00:00', 'Disabled');

-- --------------------------------------------------------

--
-- Table structure for table `cms_autorespondertags`
--

CREATE TABLE `cms_autorespondertags` (
  `Title` varchar(225) NOT NULL,
  `Tag` varchar(225) NOT NULL,
  `FieldName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_autorespondertags`
--

INSERT INTO `cms_autorespondertags` (`Title`, `Tag`, `FieldName`) VALUES
('Code', '[Code]', 'Code'),
('Email', '[Email]', 'Email'),
('First Name', '[FirstName]', 'FirstName'),
('IMEI', '[IMEI]', 'IMEI'),
('Last Name', '[LastName]', 'LastName'),
('Mobile', '[Mobile]', 'Mobile'),
('Name', '[Name]', 'Name'),
('Password', '[Password]', 'Password');

-- --------------------------------------------------------

--
-- Table structure for table `cms_nav_menus`
--

CREATE TABLE `cms_nav_menus` (
  `ID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_nav_menus`
--

INSERT INTO `cms_nav_menus` (`ID`, `Title`) VALUES
(1, 'Header');

-- --------------------------------------------------------

--
-- Table structure for table `cms_nav_menu_items`
--

CREATE TABLE `cms_nav_menu_items` (
  `ID` int(11) NOT NULL,
  `MenuID` int(11) DEFAULT NULL,
  `ParentID` int(11) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Url` varchar(255) DEFAULT NULL,
  `SortOrder` tinyint(4) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `Status` enum('Disabled','Enabled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_nav_menu_items`
--

INSERT INTO `cms_nav_menu_items` (`ID`, `MenuID`, `ParentID`, `Title`, `Url`, `SortOrder`, `UpdatedDateTime`, `CreatedDateTime`, `Status`) VALUES
(1, 1, NULL, 'Home', 'dashboard.html', 1, NULL, NULL, 'Enabled'),
(2, 1, NULL, 'IMEI Service', 'dashboard1.html', 2, NULL, NULL, 'Enabled'),
(3, 1, NULL, 'Server Service', 'dashboard1.html', 3, NULL, NULL, 'Enabled'),
(4, 1, NULL, 'Client Area', 'dashboard1.html', 4, NULL, NULL, 'Enabled'),
(5, 1, NULL, 'Order History', 'dashboard1.html', 5, NULL, NULL, 'Enabled'),
(6, 1, NULL, 'File Service', 'fileservices.html', 6, NULL, NULL, 'Enabled'),
(7, 1, NULL, 'Place Order', 'dashboard1.html', 7, NULL, NULL, 'Enabled'),
(8, 1, NULL, 'My Account', 'dashboard1.html', 8, NULL, NULL, 'Enabled');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `ID` int(11) NOT NULL,
  `PageName` varchar(255) NOT NULL COMMENT 'URL Friendly Page Name',
  `HeadTitle` varchar(255) DEFAULT NULL COMMENT 'This will be at page title bar',
  `Title` varchar(255) DEFAULT NULL COMMENT 'this will be main heading of the page',
  `Content` text,
  `MetaKeyword` varchar(255) DEFAULT NULL COMMENT 'SEO keywords will be use in Header',
  `MetaDescription` varchar(255) DEFAULT NULL COMMENT 'SEO keywords will be use in Header',
  `BannerFile` varchar(255) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `CanDelete` enum('No','Yes') DEFAULT NULL COMMENT 'Is Page Deleteable?',
  `Status` enum('Disabled','Enabled') DEFAULT NULL COMMENT 'Page Status'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_apis`
--

CREATE TABLE `gsm_apis` (
  `ID` int(11) UNSIGNED NOT NULL,
  `LibraryID` tinyint(11) UNSIGNED DEFAULT NULL,
  `ApiType` enum('Imei','File','Server') DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Host` varchar(255) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `ApiKey` varchar(255) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `Status` enum('Enabled','Disabled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gsm_apis`
--

INSERT INTO `gsm_apis` (`ID`, `LibraryID`, `ApiType`, `Title`, `Host`, `Username`, `ApiKey`, `CreatedDateTime`, `UpdatedDateTime`, `Status`) VALUES
(9, 1, 'Imei', 'unlocknetwork.co.uk', 'http://unlocknetwork.co.uk/', 'demo', 'xxxx-xxxx-xxx-xxx', '2015-12-04 15:12:22', '2017-01-14 19:28:12', 'Enabled');

-- --------------------------------------------------------

--
-- Table structure for table `gsm_api_libraries`
--

CREATE TABLE `gsm_api_libraries` (
  `ID` tinyint(11) UNSIGNED NOT NULL,
  `Title` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gsm_api_libraries`
--

INSERT INTO `gsm_api_libraries` (`ID`, `Title`) VALUES
(1, 'dhuru client');

-- --------------------------------------------------------

--
-- Table structure for table `gsm_brands`
--

CREATE TABLE `gsm_brands` (
  `BrandID` int(11) UNSIGNED NOT NULL,
  `ApiBrandID` int(11) UNSIGNED DEFAULT NULL,
  `MethodID` int(11) UNSIGNED DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `Status` enum('Disabled','Enabled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_credits`
--

CREATE TABLE `gsm_credits` (
  `ID` int(11) UNSIGNED NOT NULL,
  `MemberID` int(11) UNSIGNED DEFAULT NULL,
  `TransactionCode` char(3) DEFAULT NULL COMMENT 'IMC= IMEI Code, BFC= BroutForce Code',
  `TransactionID` int(11) UNSIGNED DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Amount` float(10,2) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Triggers `gsm_credits`
--
DELIMITER $$
CREATE TRIGGER `before_delete_credits` BEFORE DELETE ON `gsm_credits` FOR EACH ROW BEGIN
	INSERT INTO `gsm_credits_bak`(`ID`,`MemberID`,`TransactionCode`,`TransactionID`,`Description`,`Amount`,`CreatedDateTime`,`Operation`,`OperationDateTime`)
	VALUES (OLD.`ID`, OLD.`MemberID`, OLD.`TransactionCode`, OLD.`TransactionID`, OLD.`Description`, OLD.`Amount`, OLD.`CreatedDateTime`, 0, NOW());
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_credits` BEFORE UPDATE ON `gsm_credits` FOR EACH ROW BEGIN
	INSERT INTO `gsm_credits_bak`(`ID`,`MemberID`,`TransactionCode`,`TransactionID`,`Description`,`Amount`,`CreatedDateTime`,`Operation`,`OperationDateTime`)
	VALUES (OLD.`ID`, OLD.`MemberID`, OLD.`TransactionCode`, OLD.`TransactionID`, OLD.`Description`, OLD.`Amount`, OLD.`CreatedDateTime`, 1, NOW());
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_credits_bak`
--

CREATE TABLE `gsm_credits_bak` (
  `RowNum` bigint(20) UNSIGNED NOT NULL,
  `ID` int(11) UNSIGNED NOT NULL,
  `MemberID` int(11) UNSIGNED NOT NULL,
  `TransactionCode` char(3) NOT NULL COMMENT 'IMC= IMEI Code, BFC= BroutForce Code',
  `TransactionID` int(11) UNSIGNED NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Amount` float NOT NULL,
  `CreatedDateTime` datetime NOT NULL,
  `Operation` tinyint(1) NOT NULL COMMENT 'delete=0, update=1',
  `OperationDateTime` datetime NOT NULL
) ENGINE=ARCHIVE DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_fileservices`
--

CREATE TABLE `gsm_fileservices` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Title` varchar(225) DEFAULT NULL,
  `ApiID` int(11) UNSIGNED DEFAULT NULL,
  `ToolID` int(10) UNSIGNED DEFAULT NULL COMMENT 'Service ID',
  `Price` float DEFAULT NULL COMMENT 'Credit',
  `DeliveryTime` varchar(225) DEFAULT NULL,
  `Description` varchar(512) DEFAULT NULL,
  `AllowExtension` varchar(225) DEFAULT NULL COMMENT 'API Field ALLOW_EXTENSION',
  `Status` enum('Enabled','Disabled') DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gsm_fileservices`
--

INSERT INTO `gsm_fileservices` (`ID`, `Title`, `ApiID`, `ToolID`, `Price`, `DeliveryTime`, `Description`, `AllowExtension`, `Status`, `CreatedDateTime`, `UpdatedDateTime`) VALUES
(1, 'Test service', 0, 0, 10.52, '10-15 hours', 'test test test test test', 'sha,bcl,txt,log', 'Enabled', '2015-12-29 08:06:37', '2016-02-11 08:24:25');

--
-- Triggers `gsm_fileservices`
--
DELIMITER $$
CREATE TRIGGER `after_insert_fileservice` AFTER INSERT ON `gsm_fileservices` FOR EACH ROW BEGIN
	INSERT INTO `gsm_member_fileservices`(`MemberID`,`FileServiceID`,`Price`)
	SELECT
	    `U`.`ID`    
	    , NEW.`ID`
	    , ( NEW.`Price` - (NEW.`Price`  / 100 * `UG`.`Discount`) )	   
	FROM `gsm_member_groups` AS `UG`
	    INNER JOIN `gsm_members` AS `U` 
		ON (`UG`.`ID` = `U`.`MemberGroupID`);
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_fileservice` BEFORE UPDATE ON `gsm_fileservices` FOR EACH ROW BEGIN
	DECLARE fprice FLOAT;
	SELECT `Price` INTO fprice FROM `gsm_fileservices` WHERE `ID` = NEW.`ID`;
	IF NEW.`Price` <> fprice THEN
		UPDATE 
		`gsm_members` AS `M`
		    INNER JOIN `gsm_member_fileservices` AS `MF` 
			ON (`M`.`ID` = `MF`.`MemberID`)		 
		    INNER JOIN `gsm_member_groups` AS `MG` 
			ON (`M`.`MemberGroupID` = `MG`.`ID`)
		SET		 
		  `MF`.`Price` = ( NEW.`Price` - (NEW.`Price` / 100 * `MG`.`Discount`) )
		WHERE `MF`.`FileServiceID` = NEW.`ID`;
	END IF;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_fileservices_orders`
--

CREATE TABLE `gsm_fileservices_orders` (
  `ID` int(10) UNSIGNED NOT NULL,
  `MemberID` int(11) UNSIGNED DEFAULT NULL,
  `FileServiceID` int(11) UNSIGNED DEFAULT NULL,
  `IMEI` varchar(16) DEFAULT NULL,
  `ReferenceID` varchar(32) DEFAULT NULL COMMENT 'API Reference ID',
  `Code` varchar(225) DEFAULT NULL,
  `Email` varchar(64) DEFAULT NULL,
  `FileName` varchar(32) DEFAULT NULL,
  `Mobile` varchar(32) DEFAULT NULL,
  `Note` text,
  `Comments` text,
  `Status` enum('Pending','Issued','Canceled') DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gsm_fileservices_orders`
--

INSERT INTO `gsm_fileservices_orders` (`ID`, `MemberID`, `FileServiceID`, `IMEI`, `ReferenceID`, `Code`, `Email`, `FileName`, `Mobile`, `Note`, `Comments`, `Status`, `CreatedDateTime`, `UpdatedDateTime`) VALUES
(1, 2, 1, '101222', NULL, NULL, 'usman@gsmworkshop.com', '101222.sha', '45456464645', 'test test test', '', 'Canceled', '2015-12-30 10:03:44', '2016-02-17 23:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `gsm_imei_orders`
--

CREATE TABLE `gsm_imei_orders` (
  `ID` int(11) UNSIGNED NOT NULL,
  `MemberID` int(11) UNSIGNED DEFAULT NULL,
  `MethodID` int(11) UNSIGNED DEFAULT NULL,
  `Maker` varchar(255) DEFAULT NULL,
  `Model` varchar(255) DEFAULT NULL,
  `IMEI` varchar(16) DEFAULT NULL,
  `Code` varchar(50) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `MobileNo` varchar(50) DEFAULT NULL,
  `ModelID` int(11) UNSIGNED DEFAULT NULL,
  `ProviderID` int(11) UNSIGNED DEFAULT NULL,
  `MEPID` int(11) UNSIGNED DEFAULT NULL,
  `PIN` varchar(10) DEFAULT NULL,
  `KBH` varchar(20) DEFAULT NULL,
  `PRD` varchar(100) DEFAULT NULL,
  `Type` varchar(100) DEFAULT NULL,
  `Locks` varchar(100) DEFAULT NULL,
  `Reference` varchar(255) DEFAULT NULL,
  `SerialNumber` varchar(255) DEFAULT NULL,
  `Note` varchar(255) DEFAULT NULL,
  `Comments` varchar(255) DEFAULT NULL,
  `verify` tinyint(1) UNSIGNED DEFAULT '0',
  `ReferenceID` varchar(50) DEFAULT NULL COMMENT 'API REFERENCEID',
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `Status` enum('Pending','Issued','Canceled','Verified') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_logsncredits`
--

CREATE TABLE `gsm_logsncredits` (
  `ID` int(11) UNSIGNED NOT NULL,
  `Title` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `Description` text COLLATE latin1_general_ci,
  `Credits` float(11,2) NOT NULL,
  `ProcessTime` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `AvailableQuantity` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `RequireSerial` enum('Yes','No') COLLATE latin1_general_ci DEFAULT 'No',
  `RequireText` enum('Yes','No') COLLATE latin1_general_ci DEFAULT 'No',
  `Status` enum('Disabled','Enabled') COLLATE latin1_general_ci DEFAULT 'Enabled'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_logsncredit_orders`
--

CREATE TABLE `gsm_logsncredit_orders` (
  `ID` int(11) UNSIGNED NOT NULL,
  `LogsnCreditsID` int(11) UNSIGNED NOT NULL,
  `MemberID` int(11) UNSIGNED NOT NULL,
  `Quantity` int(11) UNSIGNED NOT NULL,
  `Serial` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `Instructions` tinytext COLLATE latin1_general_ci,
  `Email` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `CancelReason` text COLLATE latin1_general_ci,
  `Note` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `Comments` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `Status` enum('Pending','Issued','Canceled') COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_members`
--

CREATE TABLE `gsm_members` (
  `ID` int(11) UNSIGNED NOT NULL,
  `MemberGroupID` int(11) UNSIGNED DEFAULT '1',
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Mobile` varchar(50) DEFAULT NULL,
  `Token` varchar(30) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `Status` enum('Enabled','Disabled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gsm_members`
--

INSERT INTO `gsm_members` (`ID`, `MemberGroupID`, `FirstName`, `LastName`, `Email`, `Password`, `Mobile`, `Token`, `CreatedDateTime`, `UpdatedDateTime`, `Status`) VALUES
(2, 1, 'demo', 'LOGIN', 'demo@demo.com', '6e9bece1914809fb8493146417e722f6', '+447973471519', '2-45244', '2013-08-03 12:48:20', '2016-04-17 23:53:11', 'Enabled');

--
-- Triggers `gsm_members`
--
DELIMITER $$
CREATE TRIGGER `after_insert_member` AFTER INSERT ON `gsm_members` FOR EACH ROW BEGIN
	INSERT INTO `gsm_member_methods`(`MemberID`,`MethodID`,`Price`)
	SELECT
	    NEW.`ID`    
	    , `M`.`ID`
	    , ( `M`.`Price` - (`M`.`Price`  / 100 * `MG`.`Discount`) )	   
	FROM `gsm_methods` AS `M`, 
	    `gsm_member_groups` AS `MG`
	WHERE `MG`.`ID` = NEW.`MemberGroupID` ;
	
	INSERT INTO `gsm_member_fileservices`(`MemberID`,`FileServiceID`,`Price`)
	SELECT
	    NEW.`ID`    
	    , `FS`.`ID`
	    , ( `FS`.`Price` - (`FS`.`Price`  / 100 * `MG`.`Discount`) )	   
	FROM `gsm_fileservices` AS `FS`, 
	    `gsm_member_groups` AS `MG`
	WHERE `MG`.`ID` = NEW.`MemberGroupID` ;	
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_member` BEFORE UPDATE ON `gsm_members` FOR EACH ROW BEGIN
	IF OLD.`MemberGroupID` <> NEW.`MemberGroupID` THEN
		 	
		UPDATE 
		`gsm_members` AS `ME`
		    INNER JOIN `gsm_member_methods` AS `MM` 
			ON (`ME`.`ID` = `MM`.`MemberID`)
		    INNER JOIN `gsm_methods` AS `M` 
			ON (`M`.`ID` = `MM`.`MethodID`)
		    INNER JOIN `gsm_member_groups` AS `MG` 
			ON (`MG`.`ID` = NEW.`MemberGroupID`)
		SET 
		  `MM`.`Price` = ( `M`.`Price` - (`M`.`Price`/ 100 * `MG`.`Discount`) )
		WHERE `MM`.`MemberID` = NEW.`ID`
		    AND `MM`.`MethodID` = `M`.`ID`;
		    
		UPDATE 
		`gsm_members` AS `ME`
		    INNER JOIN `gsm_member_fileservices` AS `MF` 
			ON (`ME`.`ID` = `MF`.`MemberID`)
		    INNER JOIN `gsm_fileservices` AS `FS` 
			ON (`FS`.`ID` = `MF`.`FileServiceID`)
		    INNER JOIN `gsm_member_groups` AS `MG` 
			ON (`MG`.`ID` = NEW.`MemberGroupID`)
		SET 
		  `MF`.`Price` = ( `FS`.`Price` - (`FS`.`Price`/ 100 * `MG`.`Discount`) )
		WHERE `MF`.`MemberID` = NEW.`ID`
		    AND `MF`.`FileServiceID` = `FS`.`ID`;		    	
	END IF;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_member_fileservices`
--

CREATE TABLE `gsm_member_fileservices` (
  `MemberID` int(11) UNSIGNED NOT NULL,
  `FileServiceID` int(11) UNSIGNED NOT NULL,
  `Price` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gsm_member_fileservices`
--

INSERT INTO `gsm_member_fileservices` (`MemberID`, `FileServiceID`, `Price`) VALUES
(2, 1, 10.41);

-- --------------------------------------------------------

--
-- Table structure for table `gsm_member_groups`
--

CREATE TABLE `gsm_member_groups` (
  `ID` int(11) UNSIGNED NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Discount` float DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gsm_member_groups`
--

INSERT INTO `gsm_member_groups` (`ID`, `Title`, `Discount`, `CreatedDateTime`, `UpdatedDateTime`) VALUES
(1, 'Default Group', 1, '2013-08-03 12:34:13', '2015-12-22 07:36:25');

--
-- Triggers `gsm_member_groups`
--
DELIMITER $$
CREATE TRIGGER `before_update_member_group` BEFORE UPDATE ON `gsm_member_groups` FOR EACH ROW BEGIN
	DECLARE fdiscunt FLOAT;
	SELECT `Discount` INTO fdiscunt FROM `gsm_member_groups` WHERE `ID`=NEW.`ID`;
	
	IF NEW.`Discount` <> fdiscunt THEN
		UPDATE `gsm_methods` AS `M`
		    INNER JOIN `gsm_member_methods` AS `MM` 
			ON (`M`.`ID` = `MM`.`MethodID`)
		    INNER JOIN `gsm_members` AS `ME` 
			ON (`ME`.`ID` = `MM`.`MemberID`)
		SET		 
		  `MM`.`Price` = ( `M`.`Price` - (`M`.`Price` / 100 * NEW.`discount`) )
		WHERE (`ME`.`MemberGroupID` = NEW.`ID`);
		
		UPDATE `gsm_fileservices` AS `F`
		    INNER JOIN `gsm_member_fileservices` AS `MF` 
			ON (`F`.`ID` = `MF`.`FileServiceID`)
		    INNER JOIN `gsm_members` AS `ME` 
			ON (`ME`.`ID` = `MF`.`MemberID`)
		SET		 
		  `MF`.`Price` = ( `F`.`Price` - (`F`.`Price` / 100 * NEW.`discount`) )
		WHERE (`ME`.`MemberGroupID` = NEW.`ID`);		
	END IF;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_member_methods`
--

CREATE TABLE `gsm_member_methods` (
  `MemberID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `MethodID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `Price` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_mep`
--

CREATE TABLE `gsm_mep` (
  `ID` int(10) UNSIGNED NOT NULL,
  `MethodID` int(10) UNSIGNED DEFAULT NULL,
  `ApiMepID` int(11) UNSIGNED DEFAULT NULL,
  `Title` varchar(225) DEFAULT NULL,
  `Status` enum('Enabled','Disabled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_methods`
--

CREATE TABLE `gsm_methods` (
  `ID` int(11) UNSIGNED NOT NULL,
  `NetworkID` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `ApiID` int(11) UNSIGNED DEFAULT NULL,
  `ToolID` int(11) UNSIGNED DEFAULT NULL COMMENT 'Api service Tool ID',
  `Title` varchar(255) DEFAULT NULL,
  `DeliveryTime` varchar(255) DEFAULT NULL,
  `Description` varchar(512) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `Network` tinyint(1) DEFAULT '0',
  `Mobile` tinyint(1) DEFAULT '0',
  `SerialNumber` tinyint(1) DEFAULT '0',
  `Provider` tinyint(1) DEFAULT '0',
  `PIN` tinyint(1) DEFAULT '0',
  `KBH` tinyint(1) DEFAULT '0',
  `MEP` tinyint(1) DEFAULT '0',
  `PRD` tinyint(1) DEFAULT '0',
  `Type` tinyint(1) DEFAULT '0',
  `Locks` tinyint(1) DEFAULT '0',
  `Reference` tinyint(1) DEFAULT '0',
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `Status` enum('Enabled','Disabled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `gsm_methods`
--
DELIMITER $$
CREATE TRIGGER `after_insert_method` AFTER INSERT ON `gsm_methods` FOR EACH ROW BEGIN
	INSERT INTO `gsm_member_methods`(`MemberID`,`MethodID`,`Price`)
	SELECT
	    `U`.`ID`    
	    , NEW.`ID`
	    , ( NEW.`Price` - (NEW.`Price`  / 100 * `UG`.`Discount`) )	   
	FROM `gsm_member_groups` AS `UG`
	    INNER JOIN `gsm_members` AS `U` 
		ON (`UG`.`ID` = `U`.`MemberGroupID`);
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_method` BEFORE UPDATE ON `gsm_methods` FOR EACH ROW BEGIN
	DECLARE fprice FLOAT;
	SELECT `Price` INTO fprice FROM `gsm_methods` WHERE `ID` = NEW.`ID`;
	IF NEW.`Price` <> fprice THEN
		UPDATE 
		`gsm_members` AS `M`
		    INNER JOIN `gsm_member_methods` AS `MM` 
			ON (`M`.`ID` = `MM`.`MemberID`)		 
		    INNER JOIN `gsm_member_groups` AS `MG` 
			ON (`M`.`MemberGroupID` = `MG`.`ID`)
		SET		 
		  `MM`.`Price` = ( NEW.`Price` - (NEW.`Price` / 100 * `MG`.`Discount`) )
		WHERE `MM`.`MethodID` = NEW.`ID`;
	END IF;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_models`
--

CREATE TABLE `gsm_models` (
  `ModelID` int(11) UNSIGNED NOT NULL,
  `MethodID` int(10) UNSIGNED DEFAULT NULL,
  `BrandID` int(11) UNSIGNED DEFAULT NULL,
  `ApiModelID` int(11) UNSIGNED DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `Status` enum('Disabled','Enabled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_networks`
--

CREATE TABLE `gsm_networks` (
  `ID` int(11) UNSIGNED NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gsm_networks`
--

INSERT INTO `gsm_networks` (`ID`, `Title`, `CreatedDateTime`, `UpdatedDateTime`) VALUES
(1, 'IPHONE FACTORY UNLOCKING (EUROPE & WW)', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(2, '1A:SONY XPERIA WORLDWIDE & UK NET', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(3, '5:IPHONE WORKING IMEI SECTION ALL MODELS UK', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(4, '3:SAMSUNG UK & WORLDWIDE', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(5, '2:BLACKBERRY Z10/Z30/Q5/Q10/ (MASTER UNLOCK CODE)', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(6, '2A:NOKIA LUMIA  UK NETWORKS (MASTER UNLOCK CODE)', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(7, '4:EMEA NETWORKS', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(8, '5A:IPHONE SUPER ( EXCLUSIVE SERVICE )', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(9, '1:FACTORY CODES ( NON BOX/DONGLE CODES)', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(10, '3A:SAMSUNG USA  2014 ******** ', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(11, '2B:NOKIA SL3 (20 Digits) & Generic CODES', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(12, 'A:FIND MY IPHONE ON/OFF ( CHECKER )', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(13, '1AAA: ALL>LUMIA/NOKIA/BLACKBERRY/SAMSUNG/XPERIA', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(14, '1AA: IPAD UK NETWORKS', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(15, '6: IRELAND NETWORKS', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(16, '1AAAA:ALCATEL WORLDWIDE', '2016-02-15 16:54:51', '2016-02-15 16:54:51'),
(17, '1AA: VODAFONE UK SMART MODELS', '2016-02-15 16:54:51', '2016-02-15 16:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `gsm_payment`
--

CREATE TABLE `gsm_payment` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Type` varchar(225) DEFAULT NULL,
  `UserName` varchar(225) DEFAULT NULL,
  `Password` varchar(225) DEFAULT NULL,
  `Signature` varchar(225) DEFAULT NULL,
  `percent` float DEFAULT NULL,
  `Currency` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gsm_payment`
--

INSERT INTO `gsm_payment` (`ID`, `Type`, `UserName`, `Password`, `Signature`, `percent`, `Currency`) VALUES
(1, 'Paypal', 'areeb-facilitator_api1.ibussolutions.com', '1400332442', 'AO31O9i9zyx5x4ZkvhJjBKGVWKkKA5SONKlX5GIBRUAow90i7PrttIQq', 5, 'GBP');

-- --------------------------------------------------------

--
-- Table structure for table `gsm_provider`
--

CREATE TABLE `gsm_provider` (
  `ID` int(10) UNSIGNED NOT NULL,
  `MethodID` int(10) UNSIGNED DEFAULT NULL,
  `ApiProviderID` int(11) UNSIGNED DEFAULT NULL,
  `CountryNetworkID` int(11) UNSIGNED DEFAULT NULL,
  `Title` varchar(225) DEFAULT NULL,
  `Status` enum('Enabled','Disabled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gsm_suppliers`
--

CREATE TABLE `gsm_suppliers` (
  `ID` int(11) UNSIGNED NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Mobile` varchar(50) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `Status` enum('Enabled','Disabled') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gsm_suppliers`
--

INSERT INTO `gsm_suppliers` (`ID`, `FirstName`, `LastName`, `Email`, `Password`, `Mobile`, `CreatedDateTime`, `UpdatedDateTime`, `Status`) VALUES
(5, 'areeb', 'iqbal', 'shariq@ibussolutions.com', '40be4e59b9a2a2b5dffb918c0e86b3d7', '033212312323', '2014-05-25 17:40:50', '2014-05-25 17:40:50', 'Enabled');

-- --------------------------------------------------------

--
-- Table structure for table `gsm_supplier_methods`
--

CREATE TABLE `gsm_supplier_methods` (
  `ID` int(10) UNSIGNED NOT NULL,
  `SupplierID` int(11) UNSIGNED DEFAULT NULL,
  `MethodID` int(11) UNSIGNED DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `Status` enum('Enabled','Disabled') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gsm_supplier_methods`
--

INSERT INTO `gsm_supplier_methods` (`ID`, `SupplierID`, `MethodID`, `Price`, `Status`) VALUES
(15, 5, 2, 2, 'Enabled'),
(14, 5, 3, 3, 'Enabled'),
(13, 5, 5, 6, 'Enabled'),
(16, 5, 6, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hr_employees`
--

CREATE TABLE `hr_employees` (
  `ID` mediumint(7) UNSIGNED NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(225) DEFAULT NULL,
  `Token` varchar(20) DEFAULT NULL COMMENT 'Forgot password token',
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `IsAdmin` enum('Yes','No') DEFAULT NULL,
  `Status` enum('Disabled','Enabled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_employees`
--

INSERT INTO `hr_employees` (`ID`, `FirstName`, `LastName`, `Email`, `Password`, `Token`, `CreatedDateTime`, `UpdatedDateTime`, `IsAdmin`, `Status`) VALUES
(1, 'Muhammad', 'shariq', 'admin@exclusiveunlock.co.uk', '6e9bece1914809fb8493146417e722f6', '', '2013-05-31 15:08:36', '2016-01-06 00:18:27', 'Yes', 'Enabled');

-- --------------------------------------------------------

--
-- Table structure for table `hr_modules`
--

CREATE TABLE `hr_modules` (
  `ID` mediumint(7) UNSIGNED NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Slug` varchar(255) NOT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `Active` enum('Enabled','Disabled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_modules`
--

INSERT INTO `hr_modules` (`ID`, `Title`, `Slug`, `CreatedDateTime`, `UpdatedDateTime`, `Active`) VALUES
(1, 'API Manager', 'apimanager', '2014-07-06 10:02:34', '2014-07-06 10:02:39', 'Enabled'),
(2, 'Mobile Brands', 'brand', '2014-07-06 10:02:44', '2014-07-06 10:02:47', 'Enabled'),
(3, 'Mobile Model', 'servicemodel', NULL, NULL, NULL),
(4, 'IMEI Networks', 'network', NULL, NULL, NULL),
(5, 'IMEI Methods', 'method', NULL, NULL, NULL),
(6, 'IMEI Order', 'imeiorder', NULL, NULL, NULL),
(7, 'Member Groups', 'group', NULL, NULL, NULL),
(8, 'Members', 'member', NULL, NULL, NULL),
(9, 'File Services', 'fileservices', NULL, NULL, NULL),
(10, 'File Order', 'fileorder', NULL, NULL, NULL),
(11, 'Supplier', 'supplier', NULL, NULL, NULL),
(12, 'Employee Access', 'employee', NULL, NULL, NULL),
(13, 'Credit', 'credit', NULL, NULL, NULL),
(14, 'Email Templates', 'autoresponder', NULL, NULL, NULL),
(15, 'File manager', 'filemanager', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hr_modules_access`
--

CREATE TABLE `hr_modules_access` (
  `ID` int(9) UNSIGNED NOT NULL,
  `EmployeeID` mediumint(7) UNSIGNED NOT NULL,
  `ModuleID` mediumint(7) UNSIGNED NOT NULL,
  `Add` varchar(1) NOT NULL DEFAULT 'Y',
  `Edit` varchar(1) NOT NULL DEFAULT 'Y',
  `View` varchar(1) NOT NULL DEFAULT 'Y',
  `Delete` varchar(1) NOT NULL DEFAULT 'Y',
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_modules_access`
--

INSERT INTO `hr_modules_access` (`ID`, `EmployeeID`, `ModuleID`, `Add`, `Edit`, `View`, `Delete`, `CreatedDateTime`, `UpdatedDateTime`) VALUES
(1, 1, 1, 'Y', 'Y', 'Y', 'Y', '2014-03-08 15:42:12', '2014-03-08 15:42:17'),
(2, 1, 2, 'Y', 'Y', 'Y', 'Y', '2014-03-08 15:42:15', '2014-07-06 10:01:10'),
(3, 1, 3, 'Y', 'Y', 'Y', 'Y', '2014-07-06 12:19:39', '2014-07-06 12:19:43'),
(4, 1, 4, 'Y', 'Y', 'Y', 'Y', '2014-07-06 12:19:46', '2014-07-06 12:19:39'),
(5, 1, 5, 'Y', 'Y', 'Y', 'Y', '2014-07-06 12:19:39', '2014-07-06 12:19:39'),
(6, 1, 6, 'Y', 'Y', 'Y', 'Y', '2014-07-06 12:19:39', '2014-07-06 12:19:39'),
(7, 1, 7, 'Y', 'Y', 'Y', 'Y', '2014-07-06 12:19:39', '2014-07-06 12:19:39'),
(8, 1, 8, 'Y', 'Y', 'Y', 'Y', '2014-07-06 12:19:39', '2014-07-06 12:19:39'),
(9, 1, 9, 'Y', 'Y', 'Y', 'Y', '2014-07-06 12:19:39', '2014-07-06 12:19:39'),
(10, 1, 10, 'Y', 'Y', 'Y', 'Y', '2014-07-06 12:19:39', '2014-07-06 12:19:39'),
(11, 1, 11, 'Y', 'Y', 'Y', 'Y', '2014-07-06 12:19:39', '2014-07-06 12:19:39'),
(12, 1, 12, 'Y', 'Y', 'Y', 'Y', '2014-07-06 12:19:39', '2014-07-06 12:19:39'),
(13, 1, 13, 'Y', 'Y', 'Y', 'Y', '2014-07-06 12:19:39', '2014-07-06 12:19:39'),
(14, 1, 14, 'Y', 'Y', 'Y', 'Y', '2014-07-06 12:19:39', '2014-07-06 12:19:39'),
(15, 1, 15, 'Y', 'Y', 'Y', 'Y', '2014-07-06 12:19:39', '2014-07-06 12:19:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_autoresponders`
--
ALTER TABLE `cms_autoresponders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cms_autorespondertags`
--
ALTER TABLE `cms_autorespondertags`
  ADD PRIMARY KEY (`Tag`);

--
-- Indexes for table `cms_nav_menus`
--
ALTER TABLE `cms_nav_menus`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cms_nav_menu_items`
--
ALTER TABLE `cms_nav_menu_items`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Index_PageName` (`PageName`);

--
-- Indexes for table `gsm_apis`
--
ALTER TABLE `gsm_apis`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gsm_api_libraries`
--
ALTER TABLE `gsm_api_libraries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gsm_brands`
--
ALTER TABLE `gsm_brands`
  ADD PRIMARY KEY (`BrandID`),
  ADD KEY `MethodID` (`MethodID`);

--
-- Indexes for table `gsm_credits`
--
ALTER TABLE `gsm_credits`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gsm_credits_bak`
--
ALTER TABLE `gsm_credits_bak`
  ADD PRIMARY KEY (`RowNum`);

--
-- Indexes for table `gsm_fileservices`
--
ALTER TABLE `gsm_fileservices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gsm_fileservices_orders`
--
ALTER TABLE `gsm_fileservices_orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `gsm_fileservices_orders_ibfk_1` (`FileServiceID`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `gsm_imei_orders`
--
ALTER TABLE `gsm_imei_orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `gsm_imei_orders_ibfk_1` (`MethodID`);

--
-- Indexes for table `gsm_logsncredits`
--
ALTER TABLE `gsm_logsncredits`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gsm_logsncredit_orders`
--
ALTER TABLE `gsm_logsncredit_orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gsm_members`
--
ALTER TABLE `gsm_members`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MemberGroupID` (`MemberGroupID`);

--
-- Indexes for table `gsm_member_fileservices`
--
ALTER TABLE `gsm_member_fileservices`
  ADD PRIMARY KEY (`MemberID`,`FileServiceID`),
  ADD KEY `FileServiceID` (`FileServiceID`);

--
-- Indexes for table `gsm_member_groups`
--
ALTER TABLE `gsm_member_groups`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gsm_member_methods`
--
ALTER TABLE `gsm_member_methods`
  ADD PRIMARY KEY (`MemberID`,`MethodID`),
  ADD KEY `MethodID` (`MethodID`);

--
-- Indexes for table `gsm_mep`
--
ALTER TABLE `gsm_mep`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MethodID` (`MethodID`);

--
-- Indexes for table `gsm_methods`
--
ALTER TABLE `gsm_methods`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ApiID` (`ApiID`),
  ADD KEY `gsm_methods_ibfk_1` (`NetworkID`);

--
-- Indexes for table `gsm_models`
--
ALTER TABLE `gsm_models`
  ADD PRIMARY KEY (`ModelID`),
  ADD KEY `MethodID` (`MethodID`);

--
-- Indexes for table `gsm_networks`
--
ALTER TABLE `gsm_networks`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gsm_payment`
--
ALTER TABLE `gsm_payment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gsm_provider`
--
ALTER TABLE `gsm_provider`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MethodID` (`MethodID`);

--
-- Indexes for table `gsm_suppliers`
--
ALTER TABLE `gsm_suppliers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gsm_supplier_methods`
--
ALTER TABLE `gsm_supplier_methods`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hr_employees`
--
ALTER TABLE `hr_employees`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL_UNIQUE` (`Email`);

--
-- Indexes for table `hr_modules`
--
ALTER TABLE `hr_modules`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hr_modules_access`
--
ALTER TABLE `hr_modules_access`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EmployeeID` (`EmployeeID`),
  ADD KEY `ModuleID` (`ModuleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_autoresponders`
--
ALTER TABLE `cms_autoresponders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cms_nav_menu_items`
--
ALTER TABLE `cms_nav_menu_items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gsm_apis`
--
ALTER TABLE `gsm_apis`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `gsm_api_libraries`
--
ALTER TABLE `gsm_api_libraries`
  MODIFY `ID` tinyint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gsm_brands`
--
ALTER TABLE `gsm_brands`
  MODIFY `BrandID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gsm_credits`
--
ALTER TABLE `gsm_credits`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `gsm_credits_bak`
--
ALTER TABLE `gsm_credits_bak`
  MODIFY `RowNum` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gsm_fileservices`
--
ALTER TABLE `gsm_fileservices`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gsm_fileservices_orders`
--
ALTER TABLE `gsm_fileservices_orders`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gsm_imei_orders`
--
ALTER TABLE `gsm_imei_orders`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gsm_logsncredits`
--
ALTER TABLE `gsm_logsncredits`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gsm_logsncredit_orders`
--
ALTER TABLE `gsm_logsncredit_orders`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gsm_members`
--
ALTER TABLE `gsm_members`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `gsm_member_groups`
--
ALTER TABLE `gsm_member_groups`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gsm_mep`
--
ALTER TABLE `gsm_mep`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gsm_methods`
--
ALTER TABLE `gsm_methods`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `gsm_models`
--
ALTER TABLE `gsm_models`
  MODIFY `ModelID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gsm_networks`
--
ALTER TABLE `gsm_networks`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `gsm_payment`
--
ALTER TABLE `gsm_payment`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gsm_provider`
--
ALTER TABLE `gsm_provider`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gsm_suppliers`
--
ALTER TABLE `gsm_suppliers`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `gsm_supplier_methods`
--
ALTER TABLE `gsm_supplier_methods`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `hr_employees`
--
ALTER TABLE `hr_employees`
  MODIFY `ID` mediumint(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hr_modules`
--
ALTER TABLE `hr_modules`
  MODIFY `ID` mediumint(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `hr_modules_access`
--
ALTER TABLE `hr_modules_access`
  MODIFY `ID` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `gsm_brands`
--
ALTER TABLE `gsm_brands`
  ADD CONSTRAINT `gsm_brands_ibfk_1` FOREIGN KEY (`MethodID`) REFERENCES `gsm_methods` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gsm_fileservices_orders`
--
ALTER TABLE `gsm_fileservices_orders`
  ADD CONSTRAINT `gsm_fileservices_orders_ibfk_1` FOREIGN KEY (`FileServiceID`) REFERENCES `gsm_fileservices` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `gsm_fileservices_orders_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `gsm_members` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `gsm_imei_orders`
--
ALTER TABLE `gsm_imei_orders`
  ADD CONSTRAINT `gsm_imei_orders_ibfk_1` FOREIGN KEY (`MethodID`) REFERENCES `gsm_methods` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `gsm_imei_orders_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `gsm_members` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `gsm_members`
--
ALTER TABLE `gsm_members`
  ADD CONSTRAINT `gsm_members_ibfk_1` FOREIGN KEY (`MemberGroupID`) REFERENCES `gsm_member_groups` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `gsm_member_fileservices`
--
ALTER TABLE `gsm_member_fileservices`
  ADD CONSTRAINT `gsm_member_fileservices_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `gsm_members` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gsm_member_fileservices_ibfk_2` FOREIGN KEY (`FileServiceID`) REFERENCES `gsm_fileservices` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gsm_member_methods`
--
ALTER TABLE `gsm_member_methods`
  ADD CONSTRAINT `gsm_member_methods_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `gsm_members` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gsm_member_methods_ibfk_2` FOREIGN KEY (`MethodID`) REFERENCES `gsm_methods` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gsm_mep`
--
ALTER TABLE `gsm_mep`
  ADD CONSTRAINT `gsm_mep_ibfk_1` FOREIGN KEY (`MethodID`) REFERENCES `gsm_methods` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gsm_methods`
--
ALTER TABLE `gsm_methods`
  ADD CONSTRAINT `gsm_methods_ibfk_1` FOREIGN KEY (`NetworkID`) REFERENCES `gsm_networks` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `gsm_methods_ibfk_2` FOREIGN KEY (`ApiID`) REFERENCES `gsm_apis` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `gsm_models`
--
ALTER TABLE `gsm_models`
  ADD CONSTRAINT `gsm_models_ibfk_1` FOREIGN KEY (`MethodID`) REFERENCES `gsm_methods` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gsm_provider`
--
ALTER TABLE `gsm_provider`
  ADD CONSTRAINT `gsm_provider_ibfk_1` FOREIGN KEY (`MethodID`) REFERENCES `gsm_methods` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hr_modules_access`
--
ALTER TABLE `hr_modules_access`
  ADD CONSTRAINT `hr_modules_access_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `hr_employees` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hr_modules_access_ibfk_2` FOREIGN KEY (`ModuleID`) REFERENCES `hr_modules` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

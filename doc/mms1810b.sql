-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 05:50 AM
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
-- Database: `mms1810b`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblusers_account`
--

CREATE TABLE `tblusers_account` (
  `ID` int(11) NOT NULL,
  `EPF` varchar(10) NOT NULL,
  `EmpName` varchar(40) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Department` varchar(20) NOT NULL,
  `IssueType` varchar(40) NOT NULL,
  `Contact` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `UserType` varchar(20) NOT NULL,
  `Availability` varchar(20) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblusers_account`
--

INSERT INTO `tblusers_account` (`ID`, `EPF`, `EmpName`, `UserName`, `Password`, `Department`, `IssueType`, `Contact`, `Email`, `UserType`, `Availability`, `Status`) VALUES
(13, '7000', 'Kelum Bandara', 'kelum', '1234', 'PMD', 'All', '0772628859', 'kelum@skytechsl.com', 'Super Admin', 'Yes', 'Active'),
(32, '7002', 'Chathura', 'chatura', '1234', 'PMD', 'All', '0764081839', 'chatura@gmail.com', 'Manager', 'Yes', 'Active'),
(35, '86', 'Nalaka', 'nalaka', '1234', 'PMD', 'All', '0772655056', 'nalaka@gmail.com', 'Executive', 'Yes', 'Active'),
(801, '3', 'Thilina', 'thilina', '1234', 'PMD', 'RO,Generator', '0772569589', '34', 'TeamMember', 'Yes', 'Active'),
(799, '115', 'Kabral', 'kabral', '1234', 'PMD', 'RO,Generator', '8', '9', 'Assistance', 'Yes', 'Active'),
(800, '2', 'Rajitha', 'rajitha', '1234', 'PMD', 'RO,Generator', '12', '34', 'TeamMember', 'Yes', 'Active'),
(802, '4', 'Dhanushke', 'danushke', '1234', 'PMD', 'Pet control', '2', '4', 'Executive', 'Yes', 'Active'),
(803, '5', 'Shantha', 'shantha', '1234', 'PMD', 'Generator,Chiller', '071458956', 'shan@gmail.com', 'TeamMember', 'Yes', 'Active'),
(807, '105', 'kamal', 'kamal', '1234', 'Production', 'Pulmbing/civil', '0712569856', 'kamala@gmail.com', 'admin', 'Yes', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers_roleaccess`
--

CREATE TABLE `tblusers_roleaccess` (
  `ID` int(11) NOT NULL,
  `UserType` varchar(20) NOT NULL,
  `RoleDescription` varchar(40) NOT NULL,
  `Sections` text NOT NULL,
  `Areas` text NOT NULL,
  `Other` text NOT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblusers_roleaccess`
--

INSERT INTO `tblusers_roleaccess` (`ID`, `UserType`, `RoleDescription`, `Sections`, `Areas`, `Other`, `Status`) VALUES
(1, 'admin', 'Administrator', '10,20,201,202,203,204,205,206,30,301,302,40,401,402,403,70,', '10011,10012,10015,10016,10017,10018,1001811,1001812,1001813,1001814,1001815,1001816,1001817,10019,10020,10021,10022,10023,', '', 1),
(2, 'Executive', 'PMD Executive', '10,50,501,502,60,603,604,70,', '10015,10016,10017,10018,1001811,1001812,1001813,1001814,1001815,1001816,1001817,10021,', '9001311,9001313,9001315,', 1),
(3, 'Assistance', 'PMD Assistance (Issue Type)', '10,50,501,502,60,603,604,70,', '10012,10018,1001811,1001812,1001813,1001814,1001815,1001816,10021,', '90012,', 1),
(4, 'TeamMember', 'PMD Team Leaders and Team Members', '10,20,204,50,501,502,70,', '10012,10018,1001811,1001813,10021,', '90012,', 1),
(7, 'user', 'users in other Department', '10,20,202,203,204,205,206,30,301,302,70,', '10012,10015,10016,10017,10018,1001811,1001813,1001814,1001815,1001816,1001817,10019,10020,10021,10022,10023,', '90011,90013,9001311,9001313,9001314,', 1),
(8, 'Super Admin', 'Super Admin', '10,20,204,40,401,50,501,502,60,601,602,603,604,70,', '10012,10015,10016,10017,10018,1001811,1001812,1001813,1001814,1001815,1001816,1001817,1001818,10019,10020,10021,10022,10023,', '9001311,9001313,9001315,', 1),
(9, 'Display', 'Display Dashboard', '10,', '10011,10018,', '90013,9001311,9001313,9001314,9001315,9001316,', 1),
(11, 'Manager', 'PMD Manager s', '10,20,201,202,203,204,205,206,30,301,302,40,401,402,403,50,501,502,60,601,602,603,70,', '10015,10016,10017,10018,1001811,1001812,1001813,1001814,1001815,1001816,1001817,1001818,10021,', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblworkcentersetting_twl`
--

CREATE TABLE `tblworkcentersetting_twl` (
  `ID` int(11) NOT NULL,
  `MacAddress` varchar(20) NOT NULL,
  `Department` varchar(20) NOT NULL,
  `BuzzerState` varchar(10) NOT NULL,
  `State` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblworkcentersetting_twl`
--

INSERT INTO `tblworkcentersetting_twl` (`ID`, `MacAddress`, `Department`, `BuzzerState`, `State`) VALUES
(1, '48:3F:DA:62:AD:63', 'EngineeringRoom', 'On', 'Active'),
(2, 'D8:BF:C0:11:49:4B', 'Knitting', 'On', ''),
(3, '24:A1:60:2D:0C:E6', 'Knitting', 'On', ''),
(4, '8C:AA:B5:15:F5:62', 'Knitting', 'On', ''),
(5, '48:3F:DA:63:54:D1', 'Knitting', 'On', ''),
(6, '8C:AA:B5:15:C4:86', 'Finishing', 'On', ''),
(7, 'F0:08:D1:02:00:56', 'Dyeing', 'On', ''),
(8, 'BC:DD:C2:79:C0:1B', 'Dyeing', 'On', ''),
(9, 'F4:CF:A2:D2:51:5A', 'DryFinishing', 'On', ''),
(10, '48:3F:DA:03:DE:3D', 'DesignDevelopment', 'On', ''),
(11, '8C:AA:B5:D7:92:F4', 'Planning', 'On', ''),
(12, 'NA', 'Engineering', 'On', ''),
(13, 'NA', 'Utilities', 'On', ''),
(14, 'NA', 'QA', 'On', ''),
(15, 'NA', 'Technical', 'On', ''),
(16, 'NA', 'HR_Admin', 'On', ''),
(17, 'NA', 'Innnovation', 'On', ''),
(18, '48:3F:DA:68:83:74', 'DryFinishing', 'On', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblwo_allcheckinusers`
--

CREATE TABLE `tblwo_allcheckinusers` (
  `ID` int(11) NOT NULL,
  `WorkOrderNo` varchar(12) NOT NULL,
  `CheckInUser` varchar(20) NOT NULL,
  `CheckInServerDateTime` datetime NOT NULL,
  `CheckInUserDateTime` datetime NOT NULL,
  `CheckOutServerDateTime` datetime NOT NULL,
  `CheckOutUserDateTime` datetime NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblwo_allcheckinusers`
--

INSERT INTO `tblwo_allcheckinusers` (`ID`, `WorkOrderNo`, `CheckInUser`, `CheckInServerDateTime`, `CheckInUserDateTime`, `CheckOutServerDateTime`, `CheckOutUserDateTime`, `Status`) VALUES
(1, 'WO_00008043', '7000', '2025-01-16 09:23:59', '2025-01-16 09:23:00', '2025-01-16 16:08:21', '2025-01-16 16:08:21', 'Deactive'),
(2, 'WO_00008046', '7000', '2025-01-16 16:08:28', '2025-01-16 16:08:00', '2025-01-16 16:08:28', '2025-01-16 16:08:00', 'Active'),
(3, 'WO_00008053', '3', '2025-01-21 07:40:02', '2025-01-21 07:39:00', '2025-01-21 15:55:26', '2025-01-21 15:55:26', 'Deactive'),
(4, 'WO_00008054', '3', '2025-01-21 15:55:50', '2025-01-21 15:55:00', '2025-01-21 19:18:44', '2025-01-21 19:18:44', 'Deactive'),
(5, 'WO_00008054', '3', '2025-01-21 19:38:25', '2025-01-21 19:38:00', '2025-01-21 19:38:25', '2025-01-21 19:38:00', 'Deactive'),
(6, 'WO_00008059', '2', '2025-01-22 05:40:23', '2025-01-22 05:40:00', '2025-01-22 05:44:22', '2025-01-22 05:44:22', 'Deactive'),
(7, 'WO_00008059', '2', '2025-01-22 05:44:27', '2025-01-22 05:44:00', '2025-01-22 05:45:02', '2025-01-22 05:45:02', 'Deactive'),
(8, 'WO_00008059', '2', '2025-01-22 05:45:35', '2025-01-22 05:45:00', '2025-01-22 05:48:44', '2025-01-22 05:48:44', 'Deactive'),
(9, 'WO_00008059', '2', '2025-01-22 05:48:56', '2025-01-22 05:48:00', '2025-01-22 05:56:59', '2025-01-22 05:56:59', 'Deactive'),
(10, 'WO_00008059', '2', '2025-01-22 05:57:07', '2025-01-22 05:57:00', '2025-01-22 05:57:07', '2025-01-22 05:57:00', 'Active'),
(11, 'WO_00008060', '3', '2025-01-22 06:18:16', '2025-01-22 06:18:00', '2025-01-22 06:18:42', '2025-01-22 06:18:42', 'Deactive'),
(12, 'WO_00008060', '3', '2025-01-22 06:18:47', '2025-01-22 06:18:00', '2025-01-22 06:18:50', '2025-01-22 06:18:50', 'Deactive'),
(13, 'WO_00008066', '3', '2025-02-02 20:09:01', '2025-02-02 20:09:00', '2025-02-02 20:09:28', '2025-02-02 20:09:28', 'Deactive');

-- --------------------------------------------------------

--
-- Table structure for table `tblwo_allocatedusers`
--

CREATE TABLE `tblwo_allocatedusers` (
  `ID` int(11) NOT NULL,
  `WorkOrderNo` varchar(12) NOT NULL,
  `AllocatedBy` varchar(20) NOT NULL,
  `AllocatedUser` varchar(20) NOT NULL,
  `AllocatedServerDateTime` datetime NOT NULL,
  `AllocatedUserStartDateTime` datetime NOT NULL,
  `AllocatedUserEndDateTime` datetime NOT NULL,
  `DeAllocatedBy` varchar(20) NOT NULL,
  `DeAllocatedDateTime` datetime NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblwo_allocatedusers`
--

INSERT INTO `tblwo_allocatedusers` (`ID`, `WorkOrderNo`, `AllocatedBy`, `AllocatedUser`, `AllocatedServerDateTime`, `AllocatedUserStartDateTime`, `AllocatedUserEndDateTime`, `DeAllocatedBy`, `DeAllocatedDateTime`, `Status`) VALUES
(3151, 'WO_00008066', 'Kabral', '3', '2025-02-02 20:08:40', '2025-02-02 20:08:00', '2025-02-02 20:10:00', 'Kabral', '2025-02-02 20:08:40', 'Active'),
(3150, 'WO_00008060', 'Kabral', '3', '2025-01-22 06:14:30', '2025-01-22 06:14:00', '2025-01-23 06:14:00', 'Kabral', '2025-01-22 06:14:30', 'Active'),
(3149, 'WO_00008059', 'Kabral', '2', '2025-01-22 05:39:04', '2025-01-22 05:38:00', '2025-01-22 05:41:00', 'Kabral', '2025-01-22 05:39:04', 'Active'),
(3148, 'WO_00008054', 'Kabral', '3', '2025-01-21 07:14:12', '2025-01-21 07:13:00', '2025-01-21 10:13:00', 'Kabral', '2025-01-21 07:14:12', 'Active'),
(3140, 'WO_00008044', 'Kelum Bandara', '7002', '2025-01-16 09:36:09', '2025-01-16 09:36:00', '2025-01-16 09:39:00', 'Kelum Bandara', '2025-01-16 09:36:09', 'Active'),
(3141, 'WO_00008046', 'Kelum Bandara', '7000', '2025-01-16 16:07:50', '2025-01-16 16:07:00', '2025-01-17 16:07:00', 'Kelum Bandara', '2025-01-16 16:07:50', 'Active'),
(3142, 'WO_00008045', 'Kelum Bandara', '7002', '2025-01-17 14:42:06', '2025-01-17 14:41:00', '2025-01-17 14:44:00', 'Kelum Bandara', '2025-01-17 14:42:06', 'Active'),
(3143, 'WO_00008047', 'Kelum Bandara', '7000', '2025-01-19 10:14:08', '2025-01-19 10:13:00', '2025-01-19 10:15:00', 'Kelum Bandara', '2025-01-19 10:14:08', 'Active'),
(3144, 'WO_00008047', 'Kelum Bandara', '86', '2025-01-19 10:14:12', '2025-01-19 10:13:00', '2025-01-19 10:15:00', 'Kelum Bandara', '2025-01-19 10:14:12', 'Active'),
(3145, 'WO_00008054', 'Kabral', '3', '2025-01-19 22:59:48', '2025-01-19 22:59:00', '2025-01-19 23:01:00', 'Kabral', '2025-01-19 22:59:56', 'Deactive'),
(3146, 'WO_00008054', 'Kabral', '2', '2025-01-19 22:59:52', '2025-01-19 22:59:00', '2025-01-19 23:01:00', 'Kabral', '2025-01-21 07:14:02', 'Deactive'),
(3147, 'WO_00008053', 'Kabral', '3', '2025-01-21 06:42:40', '2025-01-21 06:42:00', '2025-01-21 10:35:00', 'Kabral', '2025-01-21 06:42:40', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblwo_event`
--

CREATE TABLE `tblwo_event` (
  `ID` int(11) NOT NULL,
  `ServerDateTime` datetime NOT NULL,
  `FactoryCode` varchar(20) NOT NULL,
  `Unit` varchar(20) NOT NULL,
  `RelatedDepartment` varchar(30) NOT NULL,
  `WorkOrderNo` varchar(12) NOT NULL,
  `WorkOrderCategory` varchar(20) NOT NULL,
  `WorkOrderSubCategory` varchar(30) NOT NULL,
  `WorkOrderSubCategory2` varchar(20) DEFAULT NULL,
  `Site` varchar(30) NOT NULL,
  `Location` varchar(30) NOT NULL,
  `Building` varchar(30) DEFAULT NULL,
  `IssueType` varchar(30) NOT NULL,
  `IssueDescriptionMain` varchar(100) NOT NULL,
  `IssueDescriptionSub` varchar(100) NOT NULL,
  `Week` varchar(4) DEFAULT NULL,
  `ServiceSection` varchar(20) DEFAULT NULL,
  `FileNo` varchar(4) DEFAULT NULL,
  `ListOfMachinery` varchar(60) DEFAULT NULL,
  `Quantity` varchar(4) DEFAULT NULL,
  `TypeOfService` varchar(60) DEFAULT NULL,
  `ResponciblePerson` varchar(30) DEFAULT NULL,
  `Contractor` varchar(40) DEFAULT NULL,
  `TimeFrequency` varchar(4) DEFAULT NULL,
  `PreArrangement` varchar(40) DEFAULT NULL,
  `Note` varchar(80) NOT NULL,
  `CreatedDateTime` datetime NOT NULL,
  `CreatedDepartment` varchar(30) NOT NULL,
  `CreatedUser` varchar(60) NOT NULL,
  `PlannedDateTime` datetime DEFAULT NULL,
  `AllocatedUser` varchar(100) NOT NULL,
  `RespondDateTime` datetime DEFAULT NULL,
  `RespondUser` varchar(30) DEFAULT NULL,
  `ClosedDateTime` datetime DEFAULT NULL,
  `ClosedUser` varchar(30) NOT NULL,
  `FaultType` varchar(30) NOT NULL,
  `UsedSpairParts` varchar(30) NOT NULL,
  `Remark` varchar(30) NOT NULL,
  `VerifiedDateTime` datetime DEFAULT NULL,
  `VerifiedUser` varchar(20) NOT NULL,
  `ReOpenedDateTime` datetime DEFAULT NULL,
  `ReOpenedUser` varchar(20) NOT NULL,
  `WoDescription` varchar(200) NOT NULL,
  `WoEventLog` text NOT NULL,
  `Shift` varchar(10) NOT NULL,
  `WoReOpen` varchar(10) DEFAULT NULL,
  `WoStatus` varchar(10) NOT NULL,
  `WoVerify` varchar(10) DEFAULT NULL,
  `AlertSentState` varchar(10) NOT NULL,
  `Attachment` varchar(50) NOT NULL,
  `State` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblwo_event`
--

INSERT INTO `tblwo_event` (`ID`, `ServerDateTime`, `FactoryCode`, `Unit`, `RelatedDepartment`, `WorkOrderNo`, `WorkOrderCategory`, `WorkOrderSubCategory`, `WorkOrderSubCategory2`, `Site`, `Location`, `Building`, `IssueType`, `IssueDescriptionMain`, `IssueDescriptionSub`, `Week`, `ServiceSection`, `FileNo`, `ListOfMachinery`, `Quantity`, `TypeOfService`, `ResponciblePerson`, `Contractor`, `TimeFrequency`, `PreArrangement`, `Note`, `CreatedDateTime`, `CreatedDepartment`, `CreatedUser`, `PlannedDateTime`, `AllocatedUser`, `RespondDateTime`, `RespondUser`, `ClosedDateTime`, `ClosedUser`, `FaultType`, `UsedSpairParts`, `Remark`, `VerifiedDateTime`, `VerifiedUser`, `ReOpenedDateTime`, `ReOpenedUser`, `WoDescription`, `WoEventLog`, `Shift`, `WoReOpen`, `WoStatus`, `WoVerify`, `AlertSentState`, `Attachment`, `State`) VALUES
(8089, '2025-02-09 09:46:38', 'MMS-1810A', 'Unit-1', 'RelatedDep', 'WO_00008089', 'Service', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2025-02-09 09:46:38', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '2025-02-09 09:46:38', '', '', '', '', '2025-02-09 09:46:38', '', NULL, '', '', 'Auto Created a Service on 2025-02-09 09:46:38', '', NULL, '', NULL, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblwo_issuetype`
--
-- Error reading structure for table mms1810b.tblwo_issuetype: #1932 - Table &#039;mms1810b.tblwo_issuetype&#039; doesn&#039;t exist in engine
-- Error reading data for table mms1810b.tblwo_issuetype: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `mms1810b`.`tblwo_issuetype`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `tblwo_masterdata_breakdown`
--

CREATE TABLE `tblwo_masterdata_breakdown` (
  `ID` int(11) NOT NULL,
  `Site` varchar(30) NOT NULL,
  `Location` varchar(30) NOT NULL,
  `Building` varchar(30) NOT NULL,
  `IssueType` varchar(30) NOT NULL,
  `IssueDescriptionMain` varchar(100) NOT NULL,
  `IssueDescriptionSub` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblwo_masterdata_breakdown`
--

INSERT INTO `tblwo_masterdata_breakdown` (`ID`, `Site`, `Location`, `Building`, `IssueType`, `IssueDescriptionMain`, `IssueDescriptionSub`) VALUES
(1, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Leaking Pipes or Fittings', 'Leaking Pipes or Fittings'),
(2, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Visible rust or corrosion on metal components, such as valves or pipes.', 'Visible rust or corrosion on metal components, such as valves or pipes.'),
(3, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Dirty or Clogged Filters', 'Dirty or Clogged Filters'),
(4, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Faulty Pressure Gauges', 'Faulty Pressure Gauges'),
(5, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Unusual Sounds', 'Unusual Sounds'),
(6, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Electrical Issues', 'Electrical Issues'),
(7, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Drainage Issues', 'Drainage Issues'),
(8, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Presence of algae growth in holding tanks or on surfaces.', 'Presence of algae growth in holding tanks or on surfaces.'),
(9, 'site 5', 'RO Plant', 'RO Plant', 'Pet control', 'Pets control issue-test', 'Pets control issue'),
(10, 'site 1', 'Genarator Room', 'Genarator Room', 'Generator', 'Oil Leaks', 'Oil Leaks'),
(11, 'site 4 ', 'Genarator Room', 'Genarator Room', 'Generator', 'Corroded Battery Terminals', 'Corroded Battery Terminals'),
(12, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Loose or Damaged Wiring', 'Loose or Damaged Wiring'),
(13, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Look for spot marking or heat marks on components', 'Look for spot marking or heat marks on components'),
(14, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Unusual exhaust emissions', 'Unusual exhaust emissions'),
(15, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Coolant Leaks', 'Coolant Leaks'),
(16, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Unusual vibration or Movement', 'Unusual vibration or Movement'),
(17, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Dirty Air Filters', 'Dirty Air Filters'),
(18, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Indicate warning lights or error messages on control panels.', 'Indicate warning lights or error messages on control panels.'),
(19, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Safety hazards', 'Safety hazards'),
(20, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Expired the mainteance services tags', 'Expired the mainteance services tags'),
(21, 'site 5', 'Genarator Room', 'Genarator Room', 'Pet control', 'Pets control issue', 'Pets control issue'),
(22, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Refrigerant Leaks', 'Refrigerant Leaks'),
(23, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Rust or corrosion on piping, fittings, or structural supports.', 'Rust or corrosion on piping, fittings, or structural supports.'),
(24, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Visible dirt or debris buildup in strainers and filters.', 'Visible dirt or debris buildup in strainers and filters.'),
(25, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Condensate Drain Problems', 'Condensate Drain Problems'),
(26, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Unusual vibrations or sounds from the chiller units or pumps.', 'Unusual vibrations or sounds from the chiller units or pumps.'),
(27, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Thermal Insulation Damage or missing insulation on pipes and equipment.', 'Thermal Insulation Damage or missing insulation on pipes and equipment.'),
(28, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Look for spot markings or heat marks on components.', 'Look for spot markings or heat marks on components.'),
(29, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Pressure and temperature gauges for incorrect readings or visible damage.', 'Pressure and temperature gauges for incorrect readings or visible damage.'),
(30, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Loose fittings in pipe and duct connections.', 'Loose fittings in pipe and duct connections.'),
(31, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Algae Growth.', 'Algae Growth.'),
(32, 'site 5', 'Chiller room', 'Chiller room', 'A/C', 'Room A C is not working.', 'Room A C is not working.'),
(33, 'site 5', 'Chiller room', 'Chiller room', 'Civil', 'Roaf or ceilling issues.', 'Roaf or ceilling issues.'),
(34, 'site 5', 'Chiller room', 'Chiller room', 'Electrical', 'Electrical Issues.', 'Electrical Issues.'),
(35, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Expired the mainteance services tags.', 'Expired the mainteance services tags.'),
(36, 'site 5', 'Chiller room', 'Chiller room', 'Pet control', 'Pets control issue.', 'Pets control issue.'),
(37, 'site 1', 'ATS Room', 'ATS Room', 'Electrical', 'Look for rust or corrosion on electrical terminals and connections.', 'Look for rust or corrosion on electrical terminals and connections.'),
(38, 'site 4 ', 'ATS Room', 'ATS Room', 'Electrical', 'Loose or exposed wiring.', 'Loose or exposed wiring.'),
(39, 'site 5', 'ATS Room', 'ATS Room', 'Electrical', 'Indicating warning lights or error messages on the ATS panel.', 'Indicating warning lights or error messages on the ATS panel.'),
(40, 'site 5', 'ATS Room', 'ATS Room', 'Electrical', 'Look for spot marks or heat damage around circuit breakers or contactors.', 'Look for spot marks or heat damage around circuit breakers or contactors.'),
(41, 'site 5', 'ATS Room', 'ATS Room', 'A/C', 'Inadequate Ventilation in room or Indoor A C is not working', 'Inadequate Ventilation in room or Indoor A C is not working'),
(42, 'site 5', 'ATS Room', 'ATS Room', 'Electrical', 'Cracks or damage to the ATS enclosure', 'Cracks or damage to the ATS enclosure'),
(43, 'site 5', 'ATS Room', 'ATS Room', 'Electrical', 'Look for burn marks or charring around electrical connections.', 'Look for burn marks or charring around electrical connections.'),
(44, 'site 5', 'ATS Room', 'ATS Room', 'Electrical', 'Grounding connections for proper installation and signs of corrosion.', 'Grounding connections for proper installation and signs of corrosion.'),
(45, 'site 5', 'ATS Room', 'ATS Room', 'Pet control', 'Pets control issue.', 'Pets control issue.'),
(46, 'site 2', 'guard room ', 'NA', 'Fire system', 'Blocked Fire Exits', 'Blocked Fire Exits'),
(47, 'site 5', 'guard room ', 'NA', 'Fire system', 'Leaking Sprinkler Heads', 'Leaking Sprinkler Heads'),
(48, 'site 4 ', 'guard room', 'NA', 'Fire system', 'Damaged Fire Hoses', 'Damaged Fire Hoses'),
(49, 'site 1', 'guard room ', '2 story', 'Fire system', 'Corroded Valves or Piping', 'Corroded Valves or Piping'),
(50, 'site 1', 'ATS Room', '5 Story', 'Fire system', 'Faulty Alarm Panels', 'Faulty Alarm Panels'),
(51, 'site 1', 'guard room - Repeating panel', 'NA', 'Fire system', 'Look for dust buildup around detectors, alarms, or sprinkler heads.', 'Look for dust buildup around detectors, alarms, or sprinkler heads.'),
(52, 'site 1', 'guard room - Repeating panel', 'NA', 'Fire system', 'Inspect smoke or heat detectors for physical damage or missing covers.', 'Inspect smoke or heat detectors for physical damage or missing covers.'),
(53, 'site 1', 'guard room - Repeating panel', 'NA', 'Fire system', 'Incorrect Labeling', 'Incorrect Labeling'),
(54, 'site 1', 'guard room - Repeating panel', 'NA', 'Civil ', 'Enterence Gate issues ', 'Enterence Gate issues '),
(55, 'site 1', 'guard room - Repeating panel', 'NA', 'A/C', 'A C are not workings', 'A C are not workings'),
(56, 'site 1', 'guard room - Repeating panel', 'NA', 'Electrical/Breakdown', 'Fans are not working', 'Fans are not working'),
(57, 'site 1', 'Comprosser room', 'Near engineering workshop', 'Compressor', 'Oil Leaks', 'Oil Leaks'),
(58, 'site 2', 'compressor room', 'Near engineering workshop', 'Compressor', 'Excessive vibration or movement of the compressor unit', 'Excessive vibration or movement of the compressor unit'),
(59, 'site 4 ', 'compressor room', 'Near engineering workshop', 'Compressor', 'Rust or corrosion on piping, fittings, and compressor parts.', 'Rust or corrosion on piping, fittings, and compressor parts.'),
(60, 'site 4 ', 'compressor room', 'Near engineering workshop', 'Compressor', 'Damaged Belts or Hoses', 'Damaged Belts or Hoses'),
(61, 'site 4', 'compressor room', 'Near engineering workshop', 'Compressor', 'Excessive Noise', 'Excessive Noise'),
(62, 'site 4', 'compressor room', 'Near engineering workshop', 'Compressor', 'Faulty Pressure Gauges', 'Faulty Pressure Gauges'),
(63, 'site 4', 'compressor room', 'Near engineering workshop', 'Compressor', 'Clogged Air Filters', 'Clogged Air Filters'),
(64, 'site 4', 'compressor room', 'Near engineering workshop', 'Compressor', 'Improper Ventilation', 'Improper Ventilation'),
(65, 'site 4', 'compressor room', 'Near engineering workshop', 'Compressor', 'Electrical Issues', 'Electrical Issues'),
(66, 'site 4', 'compressor room', 'Near engineering workshop', 'Compressor', 'Expired the mainteance services tags', 'Expired the mainteance services tags'),
(67, 'site 4', 'compressor room', 'Near engineering workshop', 'Pet control', 'Pets control issue', 'Pets control issue'),
(68, 'site 4', 'compressor room', 'Near engineering workshop', 'CCTV', 'CCTV is not working', 'CCTV is not working'),
(69, 'site 1', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Look for signs of oil pooling or stains around the transformer.', 'Look for signs of oil pooling or stains around the transformer.'),
(70, 'site 2', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Electrical connections and terminals for rust or corrosion.', 'Electrical connections and terminals for rust or corrosion.'),
(71, 'site 4 ', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Frayed or damaged insulation on wires that could pose a safety risk.', 'Frayed or damaged insulation on wires that could pose a safety risk.'),
(72, 'site 4 ', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Overheating Signs', 'Overheating Signs'),
(73, 'site 4', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Observe for unusual sounds or excessive vibration', 'Observe for unusual sounds or excessive vibration'),
(74, 'site 4', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Grounding connections for integrity and signs of corrosion.', 'Grounding connections for integrity and signs of corrosion.'),
(75, 'site 4', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Faulty Gauges', 'Faulty Gauges'),
(76, 'site 4', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Transformer floor , area and safety issues', 'Transformer floor , area and safety issues'),
(77, 'site 4', '1000kva - Transformer area', '1000kva - Transformer area', 'Pet control', 'Pets control issue', 'Pets control issue'),
(78, 'site 1', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Look for signs of leaking diesel around tanks, hoses, and connections.', 'Look for signs of leaking diesel around tanks, hoses, and connections.'),
(79, 'site 2', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Corrosion on Tanks', 'Corrosion on Tanks'),
(80, 'site 4 ', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Overfilled Tanks', 'Overfilled Tanks'),
(81, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Vent lines are blocked', 'Vent lines are blocked'),
(82, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Damaged Hoses or Fittings', 'Damaged Hoses or Fittings'),
(83, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'hoses, pumps, and other equipment are not safety condition.', 'hoses, pumps, and other equipment are not safety condition.'),
(84, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Safety and hazard signs are not visible and not satify condition.', 'Safety and hazard signs are not visible and not satify condition.'),
(85, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'leaking Issues', 'leaking Issues'),
(86, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Expired the mainteance services tags', 'Expired the mainteance services tags'),
(87, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Pet control', 'Pets control issue', 'Pets control issue'),
(88, 'site 1', 'canteen ', 'chill-out', 'Civil', 'Pipe system issues ( Tap issues, Pipe fittings leak, Foot padels issues )', 'Pipe system issues ( Tap issues, Pipe fittings leak, Foot padels issues )'),
(89, 'site 1', 'canteen - cafiteria', 'chill-out', 'Civil', 'Drainages problems', 'Drainages problems'),
(90, 'site 4 ', 'canteen ', 'chill-out', 'Civil', 'Damaged Furnitures', 'Damaged Furnitures'),
(91, 'site 4 ', 'canteen ', 'chill-out', 'Electrical', 'Electrical Issues', 'Electrical Issues'),
(92, 'site 4 ', 'canteen ', 'chill-out', 'Pet control', 'Pets control issue', 'Pets control issue'),
(93, 'site 5', 'MBC Moulding', 'AHU 1, 2, 3, 4.', 'AHU', 'Clogged or dirty air filters.', 'Clogged or dirty air filters.'),
(94, 'site 1', 'B2', 'AHU 7, 8', 'AHU', 'Look for water leaks around the AHU or associated ductwork.', 'Look for water leaks around the AHU or associated ductwork.'),
(95, 'site 5', 'Lamination,cutting', 'AHU 5,6,9,10', 'AHU', 'Corroded Ductwork.', 'Corroded Ductwork.'),
(96, 'site 1', '5 story - Ground floor', 'AHU 1,2', 'AHU', 'Drainage issues (Condensate drain for clogs or drainage)', 'Drainage issues (Condensate drain for clogs or drainage)'),
(97, 'site 1', '5 story - C1 ( 1st floor)', 'AHU 3,4', 'AHU', 'Air intake and exhaust vents are not clear of obstructions.', 'Air intake and exhaust vents are not clear of obstructions.'),
(98, 'site 1', '5 story - C2 ( 2nd floor)', 'AHU 5,6,7', 'AHU', 'Abnormal sounds from the AHU.', 'Abnormal sounds from the AHU.'),
(99, 'site 1', 'Fire system pump room 1', 'NA', 'Pulmbing', 'Leaking Pumps.', 'Leaking Pumps.'),
(100, 'site 4 ', 'Rain harvesting pump room 1', 'NA', 'Pulmbing/civil', 'Inspect metal components for rust or corrosion.', 'Inspect metal components for rust or corrosion.'),
(101, 'site 2', 'Pump room 1', 'NA', 'Electrical', 'Excessive vibration in pumps', 'Excessive vibration in pumps'),
(102, 'site 5', 'MBC Moulding', 'Duct system', 'Duct system', 'Look for dents, holes, or cracks in ductwork.', 'Look for dents, holes, or cracks in ductwork.'),
(103, 'site 2', 'QA', 'NA', 'Duct system', 'Excessive dust buildup inside of the duct.', 'Excessive dust buildup inside of the duct.'),
(104, 'site 1', 'CCP-PDC', 'NA', 'Duct system', 'Disconnected Ducts', 'Disconnected Ducts'),
(105, 'site 1', 'MBC-PDC', 'NA', 'Duct system', 'Air Leaks.', 'Air Leaks.'),
(106, 'shite 5', 'MBC ', 'Production office', 'A/C', 'Poor Air Quality or A C issue', 'Poor Air Quality or A C issue'),
(107, 'shite 5', 'MBC ', 'Obaya room', 'Electrical', 'Flickering lights, burned-out bulbs, or broken.', 'Flickering lights, burned-out bulbs, or broken.'),
(108, 'shite 5', 'MBC ', 'Meeting room 01', 'Electrical', 'Electrical Hazards: for frayed cords, overloaded outlets, or exposed wiring.', 'Electrical Hazards: for frayed cords, overloaded outlets, or exposed wiring.'),
(109, 'shite 5', 'MBC ', 'Meeting room 02', 'Civil', 'Floor damages and walkway issue', 'Floor damages and walkway issue'),
(110, 'shite 5', 'MBC ', 'Personal office', 'Civil', 'Damaged Furniture', 'Damaged Furniture'),
(111, 'shite 5', 'Lamination & Hot melt area', 'Tech pack room', 'Civil/pulmbing', 'Water or unkown oil Leaking Ceilings,Floor, near AC', 'Water or unkown oil Leaking Ceilings,Floor, near AC'),
(112, 'shite 5', 'Lamination & Hot melt area', 'Meeting room 01', 'Electrical', 'Electrical Issues', 'Electrical Issues'),
(113, 'shite 5', 'Lamination & Hot melt area', 'Manager room', 'Civil', 'Damaged or oil mark on the Carpet', 'Damaged or oil mark on the Carpet'),
(114, 'shite 5', 'Lamination & Hot melt area', 'Office 01', 'Civil', 'Walls are dirty and need a paint', 'Walls are dirty and need a paint'),
(115, 'shite 5', 'Lamination & Hot melt area', 'Office 02', 'Pet control', 'Pets control issue', 'Pets control issue'),
(116, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Battery Leaks', 'Battery Leaks'),
(117, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Overheating Components', 'Overheating Components'),
(118, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Damaged Cables', 'Damaged Cables'),
(119, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Poor Ventilation and A C issue', 'Poor Ventilation and A C issue'),
(120, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', ' Look for malfunctioning status lights or alarms on the UPS panels.', ' Look for malfunctioning status lights or alarms on the UPS panels.'),
(121, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Look for excessive dust buildup on UPS units and surrounding surfaces.', 'Look for excessive dust buildup on UPS units and surrounding surfaces.'),
(122, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Loose Connections', 'Loose Connections'),
(123, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Expired Maintenance Tags: Look for any maintenance or inspection tags that are out of date.', 'Expired Maintenance Tags: Look for any maintenance or inspection tags that are out of date.'),
(124, 'site 4', 'CNC & IM Area', 'UPS Room', 'Civil', 'Improperly Stored Items', 'Improperly Stored Items'),
(125, 'site 1', 'Walikng pathway', 'Production floor inside', 'Civil', 'Potholes', 'Potholes'),
(126, 'site 2', 'Walikng pathway', 'Production floor outside', 'Civil', 'Cracked pathway', 'Cracked pathway'),
(127, 'site 4', 'Walikng pathway', 'Production floor outside', 'Civil', 'Poor Visibility - Identify areas with inadequate lighting or Floor s painting needed.', 'Poor Visibility - Identify areas with inadequate lighting or Floor s painting needed.'),
(128, 'site 5', 'Walikng pathway', 'Production floor outside', 'Civil', 'Faulty of pathway signal indication sticker, fading or damage path way line.', 'Faulty of pathway signal indication sticker, fading or damage path way line.'),
(129, 'site 1', 'MBC-Moulding', 'Production Floor', 'Civil', 'Faulty of pathway signal indication sticker, fading or damage path way line.', 'Faulty of pathway signal indication sticker, fading or damage path way line.'),
(130, 'site 2', 'MBC-Lamination', 'Production Floor', 'Civil', 'Slip condition on the pathway', 'Slip condition on the pathway'),
(131, 'site 4', 'CCP', 'Production Floor', 'Electrical', 'Observe for excessive noise that may require hearing protection.', 'Observe for excessive noise that may require hearing protection.'),
(132, 'site 5', '5 Story - C2', 'Production Floor', 'A/C', 'Observe for areas that are too hot or too cold.', 'Observe for areas that are too hot or too cold.'),
(133, 'site 1', 'Wash room - 01 Male', 'Near HR office', 'PA System', 'Poor or high sound quality due to equipment limitations or improper settings.', 'Poor or high sound quality due to equipment limitations or improper settings.'),
(134, 'site 1', 'Wash room - 01 Female', 'Near HR office', 'PA System', 'Electrical issues and electrical safety hazards', 'Electrical issues and electrical safety hazards'),
(135, 'site 1', 'Wash room - 02 Male', 'Near chill out canteen', 'PA System', 'Volume Control Issues', 'Volume Control Issues'),
(136, 'site 1', 'Wash room - 02 Female', 'Near chill out canteen', 'PA System', 'Componets are not working or power issues (Ex : Remotes, TV, Screen display, HDMI Cables, Speaker)', 'Componets are not working or power issues (Ex : Remotes, TV, Screen display, HDMI Cables, Speaker)'),
(137, 'shite 5', 'MBC ', 'Production office', 'PA System', 'Coverage gaps and dead zone ', 'Coverage gaps and dead zone '),
(138, 'shite 5', 'MBC ', 'Obaya room', 'PA System', 'The PA system s controlling software mulfunction or not working correctly.', 'The PA system s controlling software mulfunction or not working correctly.'),
(139, 'shite 5', 'MBC ', 'Meeting room 01', 'PA System', 'Expired the mainteance services tags', 'Expired the mainteance services tags'),
(140, 'shite 5', 'MBC ', 'Meeting room 02', 'PA System', 'Aging Equipment issues', 'Aging Equipment issues'),
(141, 'shite 5', 'MBC ', 'Personal office', 'PA System', 'Physically damages to the system s equipment.', 'Physically damages to the system s equipment.'),
(142, 'Site 1', '5 story building', 'Passenger lift', 'Lifter', 'Cable Wear and Tear.', 'Cable Wear and Tear.'),
(143, 'site 1', '5 story building', 'Goods lift', 'Lifter', 'Misalignment or wear on pulleys.', 'Misalignment or wear on pulleys.');

-- --------------------------------------------------------

--
-- Table structure for table `tblwo_masterdata_redtag`
--

CREATE TABLE `tblwo_masterdata_redtag` (
  `ID` int(11) NOT NULL,
  `Site` varchar(30) NOT NULL,
  `Location` varchar(30) NOT NULL,
  `Building` varchar(30) NOT NULL,
  `IssueType` varchar(30) NOT NULL,
  `IssueDescriptionMain` varchar(100) NOT NULL,
  `IssueDescriptionSub` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblwo_masterdata_redtag`
--

INSERT INTO `tblwo_masterdata_redtag` (`ID`, `Site`, `Location`, `Building`, `IssueType`, `IssueDescriptionMain`, `IssueDescriptionSub`) VALUES
(1, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Leaking Pipes or Fittings', 'Leaking Pipes or Fittings'),
(2, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Visible rust or corrosion on metal components, such as valves or pipes.', 'Visible rust or corrosion on metal components, such as valves or pipes.'),
(3, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Dirty or Clogged Filters -kelum', 'Dirty or Clogged Filters'),
(4, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Faulty Pressure Gauges', 'Faulty Pressure Gauges'),
(5, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Unusual Sounds', 'Unusual Sounds'),
(6, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Electrical Issues', 'Electrical Issues'),
(7, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Drainage Issues', 'Drainage Issues'),
(8, 'site 5', 'RO Plant', 'RO Plant', 'RO', 'Presence of algae growth in holding tanks or on surfaces.', 'Presence of algae growth in holding tanks or on surfaces.'),
(9, 'site 5', 'RO Plant', 'RO Plant', 'Pet control', 'Pets control issue', 'Pets control issue'),
(10, 'site 1', 'Genarator Room', 'Genarator Room', 'Generator', 'Oil Leaks', 'Oil Leaks'),
(11, 'site 4 ', 'Genarator Room', 'Genarator Room', 'Generator', 'Corroded Battery Terminals', 'Corroded Battery Terminals'),
(12, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Loose or Damaged Wiring', 'Loose or Damaged Wiring'),
(13, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Look for spot marking or heat marks on components', 'Look for spot marking or heat marks on components'),
(14, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Unusual exhaust emissions', 'Unusual exhaust emissions'),
(15, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Coolant Leaks', 'Coolant Leaks'),
(16, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Unusual vibration or Movement', 'Unusual vibration or Movement'),
(17, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Dirty Air Filters', 'Dirty Air Filters'),
(18, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Indicate warning lights or error messages on control panels.', 'Indicate warning lights or error messages on control panels.'),
(19, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Safety hazards', 'Safety hazards'),
(20, 'site 5', 'Genarator Room', 'Genarator Room', 'Generator', 'Expired the mainteance services tags', 'Expired the mainteance services tags'),
(21, 'site 5', 'Genarator Room', 'Genarator Room', 'Pet control', 'Pets control issue', 'Pets control issue'),
(22, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Refrigerant Leaks', 'Refrigerant Leaks'),
(23, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Rust or corrosion on piping, fittings, or structural supports.', 'Rust or corrosion on piping, fittings, or structural supports.'),
(24, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Visible dirt or debris buildup in strainers and filters.', 'Visible dirt or debris buildup in strainers and filters.'),
(25, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Condensate Drain Problems', 'Condensate Drain Problems'),
(26, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Unusual vibrations or sounds from the chiller units or pumps.', 'Unusual vibrations or sounds from the chiller units or pumps.'),
(27, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Thermal Insulation Damage or missing insulation on pipes and equipment.', 'Thermal Insulation Damage or missing insulation on pipes and equipment.'),
(28, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Look for spot markings or heat marks on components.', 'Look for spot markings or heat marks on components.'),
(29, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Pressure and temperature gauges for incorrect readings or visible damage.', 'Pressure and temperature gauges for incorrect readings or visible damage.'),
(30, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Loose fittings in pipe and duct connections.', 'Loose fittings in pipe and duct connections.'),
(31, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Algae Growth.', 'Algae Growth.'),
(32, 'site 5', 'Chiller room', 'Chiller room', 'A/C', 'Room A C is not working.', 'Room A C is not working.'),
(33, 'site 5', 'Chiller room', 'Chiller room', 'Civil', 'Roaf or ceilling issues.', 'Roaf or ceilling issues.'),
(34, 'site 5', 'Chiller room', 'Chiller room', 'Electrical', 'Electrical Issues.', 'Electrical Issues.'),
(35, 'site 5', 'Chiller room', 'Chiller room', 'Chiller', 'Expired the mainteance services tags.', 'Expired the mainteance services tags.'),
(36, 'site 5', 'Chiller room', 'Chiller room', 'Pet control', 'Pets control issue.', 'Pets control issue.'),
(37, 'site 1', 'ATS Room', 'ATS Room', 'Electrical', 'Look for rust or corrosion on electrical terminals and connections.', 'Look for rust or corrosion on electrical terminals and connections.'),
(38, 'site 4 ', 'ATS Room', 'ATS Room', 'Electrical', 'Loose or exposed wiring.', 'Loose or exposed wiring.'),
(39, 'site 5', 'ATS Room', 'ATS Room', 'Electrical', 'Indicating warning lights or error messages on the ATS panel.', 'Indicating warning lights or error messages on the ATS panel.'),
(40, 'site 5', 'ATS Room', 'ATS Room', 'Electrical', 'Look for spot marks or heat damage around circuit breakers or contactors.', 'Look for spot marks or heat damage around circuit breakers or contactors.'),
(41, 'site 5', 'ATS Room', 'ATS Room', 'A/C', 'Inadequate Ventilation in room or Indoor A C is not working', 'Inadequate Ventilation in room or Indoor A C is not working'),
(42, 'site 5', 'ATS Room', 'ATS Room', 'Electrical', 'Cracks or damage to the ATS enclosure', 'Cracks or damage to the ATS enclosure'),
(43, 'site 5', 'ATS Room', 'ATS Room', 'Electrical', 'Look for burn marks or charring around electrical connections.', 'Look for burn marks or charring around electrical connections.'),
(44, 'site 5', 'ATS Room', 'ATS Room', 'Electrical', 'Grounding connections for proper installation and signs of corrosion.', 'Grounding connections for proper installation and signs of corrosion.'),
(45, 'site 5', 'ATS Room', 'ATS Room', 'Pet control', 'Pets control issue.', 'Pets control issue.'),
(46, 'site 2', 'guard room ', 'NA', 'Fire system', 'Blocked Fire Exits', 'Blocked Fire Exits'),
(47, 'site 5', 'guard room ', 'NA', 'Fire system', 'Leaking Sprinkler Heads', 'Leaking Sprinkler Heads'),
(48, 'site 4 ', 'guard room', 'NA', 'Fire system', 'Damaged Fire Hoses', 'Damaged Fire Hoses'),
(49, 'site 1', 'guard room ', '2 story', 'Fire system', 'Corroded Valves or Piping', 'Corroded Valves or Piping'),
(50, 'site 1', 'ATS Room', '5 Story', 'Fire system', 'Faulty Alarm Panels', 'Faulty Alarm Panels'),
(51, 'site 1', 'guard room - Repeating panel', 'NA', 'Fire system', 'Look for dust buildup around detectors, alarms, or sprinkler heads.', 'Look for dust buildup around detectors, alarms, or sprinkler heads.'),
(52, 'site 1', 'guard room - Repeating panel', 'NA', 'Fire system', 'Inspect smoke or heat detectors for physical damage or missing covers.', 'Inspect smoke or heat detectors for physical damage or missing covers.'),
(53, 'site 1', 'guard room - Repeating panel', 'NA', 'Fire system', 'Incorrect Labeling', 'Incorrect Labeling'),
(54, 'site 1', 'guard room - Repeating panel', 'NA', 'Civil ', 'Enterence Gate issues ', 'Enterence Gate issues '),
(55, 'site 1', 'guard room - Repeating panel', 'NA', 'A/C', 'A C are not workings', 'A C are not workings'),
(56, 'site 1', 'guard room - Repeating panel', 'NA', 'Electrical/Breakdown', 'Fans are not working', 'Fans are not working'),
(57, 'site 1', 'Comprosser room', 'Near engineering workshop', 'Compressor', 'Oil Leaks', 'Oil Leaks'),
(58, 'site 2', 'compressor room', 'Near engineering workshop', 'Compressor', 'Excessive vibration or movement of the compressor unit', 'Excessive vibration or movement of the compressor unit'),
(59, 'site 4 ', 'compressor room', 'Near engineering workshop', 'Compressor', 'Rust or corrosion on piping, fittings, and compressor parts.', 'Rust or corrosion on piping, fittings, and compressor parts.'),
(60, 'site 4 ', 'compressor room', 'Near engineering workshop', 'Compressor', 'Damaged Belts or Hoses', 'Damaged Belts or Hoses'),
(61, 'site 4', 'compressor room', 'Near engineering workshop', 'Compressor', 'Excessive Noise', 'Excessive Noise'),
(62, 'site 4', 'compressor room', 'Near engineering workshop', 'Compressor', 'Faulty Pressure Gauges', 'Faulty Pressure Gauges'),
(63, 'site 4', 'compressor room', 'Near engineering workshop', 'Compressor', 'Clogged Air Filters', 'Clogged Air Filters'),
(64, 'site 4', 'compressor room', 'Near engineering workshop', 'Compressor', 'Improper Ventilation', 'Improper Ventilation'),
(65, 'site 4', 'compressor room', 'Near engineering workshop', 'Compressor', 'Electrical Issues', 'Electrical Issues'),
(66, 'site 4', 'compressor room', 'Near engineering workshop', 'Compressor', 'Expired the mainteance services tags', 'Expired the mainteance services tags'),
(67, 'site 4', 'compressor room', 'Near engineering workshop', 'Pet control', 'Pets control issue', 'Pets control issue'),
(68, 'site 4', 'compressor room', 'Near engineering workshop', 'CCTV', 'CCTV is not working', 'CCTV is not working'),
(69, 'site 1', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Look for signs of oil pooling or stains around the transformer.', 'Look for signs of oil pooling or stains around the transformer.'),
(70, 'site 2', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Electrical connections and terminals for rust or corrosion.', 'Electrical connections and terminals for rust or corrosion.'),
(71, 'site 4 ', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Frayed or damaged insulation on wires that could pose a safety risk.', 'Frayed or damaged insulation on wires that could pose a safety risk.'),
(72, 'site 4 ', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Overheating Signs', 'Overheating Signs'),
(73, 'site 4', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Observe for unusual sounds or excessive vibration', 'Observe for unusual sounds or excessive vibration'),
(74, 'site 4', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Grounding connections for integrity and signs of corrosion.', 'Grounding connections for integrity and signs of corrosion.'),
(75, 'site 4', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Faulty Gauges', 'Faulty Gauges'),
(76, 'site 4', '1000kva - Transformer area', '1000kva - Transformer area', 'Transformer', 'Transformer floor , area and safety issues', 'Transformer floor , area and safety issues'),
(77, 'site 4', '1000kva - Transformer area', '1000kva - Transformer area', 'Pet control', 'Pets control issue', 'Pets control issue'),
(78, 'site 1', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Look for signs of leaking diesel around tanks, hoses, and connections.', 'Look for signs of leaking diesel around tanks, hoses, and connections.'),
(79, 'site 2', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Corrosion on Tanks', 'Corrosion on Tanks'),
(80, 'site 4 ', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Overfilled Tanks', 'Overfilled Tanks'),
(81, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Vent lines are blocked', 'Vent lines are blocked'),
(82, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Damaged Hoses or Fittings', 'Damaged Hoses or Fittings'),
(83, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'hoses, pumps, and other equipment are not safety condition.', 'hoses, pumps, and other equipment are not safety condition.'),
(84, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Safety and hazard signs are not visible and not satify condition.', 'Safety and hazard signs are not visible and not satify condition.'),
(85, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'leaking Issues', 'leaking Issues'),
(86, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Diesel storage', 'Expired the mainteance services tags', 'Expired the mainteance services tags'),
(87, 'site 5', 'Diesel tank area', 'Diesel tank area', 'Pet control', 'Pets control issue', 'Pets control issue'),
(88, 'site 1', 'canteen ', 'chill-out', 'Civil', 'Pipe system issues ( Tap issues, Pipe fittings leak, Foot padels issues )', 'Pipe system issues ( Tap issues, Pipe fittings leak, Foot padels issues )'),
(89, 'site 1', 'canteen - cafiteria', 'chill-out', 'Civil', 'Drainages problems', 'Drainages problems'),
(90, 'site 4 ', 'canteen ', 'chill-out', 'Civil', 'Damaged Furnitures', 'Damaged Furnitures'),
(91, 'site 4 ', 'canteen ', 'chill-out', 'Electrical', 'Electrical Issues', 'Electrical Issues'),
(92, 'site 4 ', 'canteen ', 'chill-out', 'Pet control', 'Pets control issue', 'Pets control issue'),
(93, 'site 5', 'MBC Moulding', 'AHU 1, 2, 3, 4.', 'AHU', 'Clogged or dirty air filters.', 'Clogged or dirty air filters.'),
(94, 'site 1', 'B2', 'AHU 7, 8', 'AHU', 'Look for water leaks around the AHU or associated ductwork.', 'Look for water leaks around the AHU or associated ductwork.'),
(95, 'site 5', 'Lamination,cutting', 'AHU 5,6,9,10', 'AHU', 'Corroded Ductwork.', 'Corroded Ductwork.'),
(96, 'site 1', '5 story - Ground floor', 'AHU 1,2', 'AHU', 'Drainage issues (Condensate drain for clogs or drainage)', 'Drainage issues (Condensate drain for clogs or drainage)'),
(97, 'site 1', '5 story - C1 ( 1st floor)', 'AHU 3,4', 'AHU', 'Air intake and exhaust vents are not clear of obstructions.', 'Air intake and exhaust vents are not clear of obstructions.'),
(98, 'site 1', '5 story - C2 ( 2nd floor)', 'AHU 5,6,7', 'AHU', 'Abnormal sounds from the AHU.', 'Abnormal sounds from the AHU.'),
(99, 'site 1', 'Fire system pump room 1', 'NA', 'Pulmbing', 'Leaking Pumps.', 'Leaking Pumps.'),
(100, 'site 4 ', 'Rain harvesting pump room 1', 'NA', 'Pulmbing/civil', 'Inspect metal components for rust or corrosion.', 'Inspect metal components for rust or corrosion.'),
(101, 'site 2', 'Pump room 1', 'NA', 'Electrical', 'Excessive vibration in pumps', 'Excessive vibration in pumps'),
(102, 'site 5', 'MBC Moulding', 'Duct system', 'Duct system', 'Look for dents, holes, or cracks in ductwork.', 'Look for dents, holes, or cracks in ductwork.'),
(103, 'site 2', 'QA', 'NA', 'Duct system', 'Excessive dust buildup inside of the duct.', 'Excessive dust buildup inside of the duct.'),
(104, 'site 1', 'CCP-PDC', 'NA', 'Duct system', 'Disconnected Ducts', 'Disconnected Ducts'),
(105, 'site 1', 'MBC-PDC', 'NA', 'Duct system', 'Air Leaks.', 'Air Leaks.'),
(106, 'shite 5', 'MBC ', 'Production office', 'A/C', 'Poor Air Quality or A C issue', 'Poor Air Quality or A C issue'),
(107, 'shite 5', 'MBC ', 'Obaya room', 'Electrical', 'Flickering lights, burned-out bulbs, or broken.', 'Flickering lights, burned-out bulbs, or broken.'),
(108, 'shite 5', 'MBC ', 'Meeting room 01', 'Electrical', 'Electrical Hazards: for frayed cords, overloaded outlets, or exposed wiring.', 'Electrical Hazards: for frayed cords, overloaded outlets, or exposed wiring.'),
(109, 'shite 5', 'MBC ', 'Meeting room 02', 'Civil', 'Floor damages and walkway issue', 'Floor damages and walkway issue'),
(110, 'shite 5', 'MBC ', 'Personal office', 'Civil', 'Damaged Furniture', 'Damaged Furniture'),
(111, 'shite 5', 'Lamination & Hot melt area', 'Tech pack room', 'Civil/pulmbing', 'Water or unkown oil Leaking Ceilings,Floor, near AC', 'Water or unkown oil Leaking Ceilings,Floor, near AC'),
(112, 'shite 5', 'Lamination & Hot melt area', 'Meeting room 01', 'Electrical', 'Electrical Issues', 'Electrical Issues'),
(113, 'shite 5', 'Lamination & Hot melt area', 'Manager room', 'Civil', 'Damaged or oil mark on the Carpet', 'Damaged or oil mark on the Carpet'),
(114, 'shite 5', 'Lamination & Hot melt area', 'Office 01', 'Civil', 'Walls are dirty and need a paint', 'Walls are dirty and need a paint'),
(115, 'shite 5', 'Lamination & Hot melt area', 'Office 02', 'Pet control', 'Pets control issue', 'Pets control issue'),
(116, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Battery Leaks', 'Battery Leaks'),
(117, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Overheating Components', 'Overheating Components'),
(118, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Damaged Cables', 'Damaged Cables'),
(119, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Poor Ventilation and A C issue', 'Poor Ventilation and A C issue'),
(120, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', ' Look for malfunctioning status lights or alarms on the UPS panels.', ' Look for malfunctioning status lights or alarms on the UPS panels.'),
(121, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Look for excessive dust buildup on UPS units and surrounding surfaces.', 'Look for excessive dust buildup on UPS units and surrounding surfaces.'),
(122, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Loose Connections', 'Loose Connections'),
(123, 'site 4', 'CNC & IM Area', 'UPS Room', 'Electrical', 'Expired Maintenance Tags: Look for any maintenance or inspection tags that are out of date.', 'Expired Maintenance Tags: Look for any maintenance or inspection tags that are out of date.'),
(124, 'site 4', 'CNC & IM Area', 'UPS Room', 'Civil', 'Improperly Stored Items', 'Improperly Stored Items'),
(125, 'site 1', 'Walikng pathway', 'Production floor inside', 'Civil', 'Potholes', 'Potholes'),
(126, 'site 2', 'Walikng pathway', 'Production floor outside', 'Civil', 'Cracked pathway', 'Cracked pathway'),
(127, 'site 4', 'Walikng pathway', 'Production floor outside', 'Civil', 'Poor Visibility - Identify areas with inadequate lighting or Floor s painting needed.', 'Poor Visibility - Identify areas with inadequate lighting or Floor s painting needed.'),
(128, 'site 5', 'Walikng pathway', 'Production floor outside', 'Civil', 'Faulty of pathway signal indication sticker, fading or damage path way line.', 'Faulty of pathway signal indication sticker, fading or damage path way line.'),
(129, 'site 1', 'MBC-Moulding', 'Production Floor', 'Civil', 'Faulty of pathway signal indication sticker, fading or damage path way line.', 'Faulty of pathway signal indication sticker, fading or damage path way line.'),
(130, 'site 2', 'MBC-Lamination', 'Production Floor', 'Civil', 'Slip condition on the pathway', 'Slip condition on the pathway'),
(131, 'site 4', 'CCP', 'Production Floor', 'Electrical', 'Observe for excessive noise that may require hearing protection.', 'Observe for excessive noise that may require hearing protection.'),
(132, 'site 5', '5 Story - C2', 'Production Floor', 'A/C', 'Observe for areas that are too hot or too cold.', 'Observe for areas that are too hot or too cold.'),
(133, 'site 1', 'Wash room - 01 Male', 'Near HR office', 'PA System', 'Poor or high sound quality due to equipment limitations or improper settings.', 'Poor or high sound quality due to equipment limitations or improper settings.'),
(134, 'site 1', 'Wash room - 01 Female', 'Near HR office', 'PA System', 'Electrical issues and electrical safety hazards', 'Electrical issues and electrical safety hazards'),
(135, 'site 1', 'Wash room - 02 Male', 'Near chill out canteen', 'PA System', 'Volume Control Issues', 'Volume Control Issues'),
(136, 'site 1', 'Wash room - 02 Female', 'Near chill out canteen', 'PA System', 'Componets are not working or power issues (Ex : Remotes, TV, Screen display, HDMI Cables, Speaker)', 'Componets are not working or power issues (Ex : Remotes, TV, Screen display, HDMI Cables, Speaker)'),
(137, 'shite 5', 'MBC ', 'Production office', 'PA System', 'Coverage gaps and dead zone ', 'Coverage gaps and dead zone '),
(138, 'shite 5', 'MBC ', 'Obaya room', 'PA System', 'The PA system s controlling software mulfunction or not working correctly.', 'The PA system s controlling software mulfunction or not working correctly.'),
(139, 'shite 5', 'MBC ', 'Meeting room 01', 'PA System', 'Expired the mainteance services tags', 'Expired the mainteance services tags'),
(140, 'shite 5', 'MBC ', 'Meeting room 02', 'PA System', 'Aging Equipment issues', 'Aging Equipment issues'),
(141, 'shite 5', 'MBC ', 'Personal office', 'PA System', 'Physically damages to the system s equipment.', 'Physically damages to the system s equipment.'),
(142, 'Site 1', '5 story building', 'Passenger lift', 'Lifter', 'Cable Wear and Tear.', 'Cable Wear and Tear.'),
(143, 'site 1', '5 story building', 'Goods lift', 'Lifter', 'Misalignment or wear on pulleys.', 'Misalignment or wear on pulleys.');

-- --------------------------------------------------------

--
-- Table structure for table `tblwo_masterdata_service`
--

CREATE TABLE `tblwo_masterdata_service` (
  `ID` int(11) NOT NULL,
  `ServerDateTime` datetime NOT NULL,
  `FileNo` varchar(4) DEFAULT NULL,
  `ServiceSection` varchar(20) DEFAULT NULL,
  `ListOfMachinery` varchar(60) DEFAULT NULL,
  `Quantity` varchar(4) DEFAULT NULL,
  `TypeOfService` varchar(60) DEFAULT NULL,
  `ResponciblePerson` varchar(30) DEFAULT NULL,
  `Contractor` varchar(40) DEFAULT NULL,
  `TimeFrequency` varchar(4) DEFAULT NULL,
  `PreArrangement` varchar(40) DEFAULT NULL,
  `WeekNo` varchar(60) DEFAULT NULL,
  `PlannedDateTime` datetime DEFAULT NULL,
  `State` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblwo_masterdata_service`
--

INSERT INTO `tblwo_masterdata_service` (`ID`, `ServerDateTime`, `FileNo`, `ServiceSection`, `ListOfMachinery`, `Quantity`, `TypeOfService`, `ResponciblePerson`, `Contractor`, `TimeFrequency`, `PreArrangement`, `WeekNo`, `PlannedDateTime`, `State`) VALUES
(1, '2025-02-09 08:19:18', '1', 'Civil', 'Water filter - Sand  site 01 & 02', '2', 'Full service,change sand & carban', 'Dhanushka, Harshana', 'SAS hydrotech', 'year', '', '16', '2025-04-14 00:00:00', 0),
(2, '2025-02-09 08:19:18', '2', 'Civil', 'Water filter - Micron, site -05', '10', 'full service, change filter', 'Dhanushka, Harshana', 'SAS hydrotech', '6 Mo', '', '16', '2025-04-14 00:00:00', 0),
(3, '2025-02-09 08:19:18', '2', 'Civil', 'Water filter - Micron, site -05', '10', 'full service, change filter', 'Dhanushka, Harshana', 'SAS hydrotech', '6 Mo', '', '42', '2025-10-13 00:00:00', 0),
(4, '2025-02-09 08:19:18', '3', 'Civil', 'Water filter - sand , site -05', '1', 'Full service,change sand & carban', 'Dhanushka, Harshana', 'SAS hydrotech', 'year', '', '16', '2025-04-14 00:00:00', 0),
(5, '2025-02-09 08:19:18', '3', 'Civil', 'Water filter - sand , site -05', '1', 'Full service,change sand & carban', 'Dhanushka, Harshana', 'SAS hydrotech', 'year', '', '42', '2025-10-13 00:00:00', 0),
(6, '2025-02-09 08:19:18', '4', 'Civil', 'Water filter -  carbon., site 05', '1', 'Full service,change sand & carban', 'Dhanushka, Harshana', 'SAS hydrotech', '6 Mo', '', '16', '2025-04-14 00:00:00', 0),
(7, '2025-02-09 08:19:18', '4', 'Civil', 'Water filter -  carbon., site 05', '1', 'Full service,change sand & carban', 'Dhanushka, Harshana', 'SAS hydrotech', '6 Mo', '', '42', '2025-10-13 00:00:00', 0),
(8, '2025-02-09 08:19:18', '5', 'Civil', 'Car park Demarcation', '4', 'paint', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '5', '2025-01-27 00:00:00', 0),
(9, '2025-02-09 08:19:18', '5', 'Civil', 'Car park Demarcation', '4', 'paint', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '18', '2025-04-28 00:00:00', 0),
(10, '2025-02-09 08:19:18', '5', 'Civil', 'Car park Demarcation', '4', 'paint', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '31', '2025-07-28 00:00:00', 0),
(11, '2025-02-09 08:19:18', '5', 'Civil', 'Car park Demarcation', '4', 'paint', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '44', '2025-10-27 00:00:00', 0),
(12, '2025-02-09 08:19:18', '6', 'Civil', 'Main Pathway Demacation', '3', 'paint', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '4', '2025-01-20 00:00:00', 0),
(13, '2025-02-09 08:19:18', '6', 'Civil', 'Main Pathway Demacation', '3', 'paint', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '17', '2025-04-21 00:00:00', 0),
(14, '2025-02-09 08:19:18', '6', 'Civil', 'Main Pathway Demacation', '3', 'paint', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '30', '2025-07-21 00:00:00', 0),
(15, '2025-02-09 08:19:18', '6', 'Civil', 'Main Pathway Demacation', '3', 'paint', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '43', '2025-10-20 00:00:00', 0),
(16, '2025-02-09 08:19:18', '7', 'Civil', 'Door closer service', '165', 'clean', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '5', '2025-01-27 00:00:00', 0),
(17, '2025-02-09 08:19:18', '7', 'Civil', 'Door closer service', '165', 'clean', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '18', '2025-04-28 00:00:00', 0),
(18, '2025-02-09 08:19:18', '7', 'Civil', 'Door closer service', '165', 'clean', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '31', '2025-07-28 00:00:00', 0),
(19, '2025-02-09 08:19:18', '7', 'Civil', 'Door closer service', '165', 'clean', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '44', '2025-10-27 00:00:00', 0),
(20, '2025-02-09 08:19:18', '8', 'Civil', 'Door Checking(main)', '25', 'Condition Check', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '3', '2025-01-13 00:00:00', 0),
(21, '2025-02-09 08:19:18', '8', 'Civil', 'Door Checking(main)', '25', 'Condition Check', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '7', '2025-02-10 00:00:00', 0),
(22, '2025-02-09 08:19:18', '8', 'Civil', 'Door Checking(main)', '25', 'Condition Check', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '12', '2025-03-17 00:00:00', 0),
(23, '2025-02-09 08:19:18', '8', 'Civil', 'Door Checking(main)', '25', 'Condition Check', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '17', '2025-04-21 00:00:00', 0),
(24, '2025-02-09 08:19:18', '8', 'Civil', 'Door Checking(main)', '25', 'Condition Check', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '22', '2025-05-26 00:00:00', 0),
(25, '2025-02-09 08:19:18', '8', 'Civil', 'Door Checking(main)', '25', 'Condition Check', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '27', '2025-06-30 00:00:00', 0),
(26, '2025-02-09 08:19:18', '8', 'Civil', 'Door Checking(main)', '25', 'Condition Check', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '32', '2025-08-04 00:00:00', 0),
(27, '2025-02-09 08:19:18', '8', 'Civil', 'Door Checking(main)', '25', 'Condition Check', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '37', '2025-09-08 00:00:00', 0),
(28, '2025-02-09 08:19:18', '8', 'Civil', 'Door Checking(main)', '25', 'Condition Check', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '42', '2025-10-13 00:00:00', 0),
(29, '2025-02-09 08:19:18', '8', 'Civil', 'Door Checking(main)', '25', 'Condition Check', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '47', '2025-11-17 00:00:00', 0),
(30, '2025-02-09 08:19:18', '9', 'Civil', 'Gate Service', '7', 'grease,', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '8', '2025-02-17 00:00:00', 0),
(31, '2025-02-09 08:19:18', '9', 'Civil', 'Gate Service', '7', 'grease,', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '21', '2025-05-19 00:00:00', 0),
(32, '2025-02-09 08:19:18', '9', 'Civil', 'Gate Service', '7', 'grease,', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '35', '2025-08-25 00:00:00', 0),
(33, '2025-02-09 08:19:18', '9', 'Civil', 'Gate Service', '7', 'grease,', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '48', '2025-11-24 00:00:00', 0),
(34, '2025-02-09 08:19:18', '10', 'Civil', 'Gate paint', '7', 'gate paint, ', 'Dhanushka, Harshana', 'pmd', 'Mont', '', '8', '2025-02-17 00:00:00', 0),
(35, '2025-02-09 08:19:18', '10', 'Civil', 'Gate paint', '7', 'gate paint, ', 'Dhanushka, Harshana', 'pmd', 'Mont', '', '21', '2025-05-19 00:00:00', 0),
(36, '2025-02-09 08:19:18', '10', 'Civil', 'Gate paint', '7', 'gate paint, ', 'Dhanushka, Harshana', 'pmd', 'Mont', '', '35', '2025-08-25 00:00:00', 0),
(37, '2025-02-09 08:19:18', '10', 'Civil', 'Gate paint', '7', 'gate paint, ', 'Dhanushka, Harshana', 'pmd', 'Mont', '', '48', '2025-11-24 00:00:00', 0),
(38, '2025-02-09 08:19:18', '11', 'Civil', 'Water Dispenser', '29', 'Filter Cleaning', 'Dhanushka, Harshana', 'PMD', 'mont', '', '3', '2025-01-13 00:00:00', 0),
(39, '2025-02-09 08:19:18', '11', 'Civil', 'Water Dispenser', '29', 'Filter Cleaning', 'Dhanushka, Harshana', 'PMD', 'mont', '', '7', '2025-02-10 00:00:00', 0),
(40, '2025-02-09 08:19:18', '11', 'Civil', 'Water Dispenser', '29', 'Filter Cleaning', 'Dhanushka, Harshana', 'PMD', 'mont', '', '12', '2025-03-17 00:00:00', 0),
(41, '2025-02-09 08:19:18', '11', 'Civil', 'Water Dispenser', '29', 'Filter Cleaning', 'Dhanushka, Harshana', 'PMD', 'mont', '', '17', '2025-04-21 00:00:00', 0),
(42, '2025-02-09 08:19:18', '11', 'Civil', 'Water Dispenser', '29', 'Filter Cleaning', 'Dhanushka, Harshana', 'PMD', 'mont', '', '22', '2025-05-26 00:00:00', 0),
(43, '2025-02-09 08:19:18', '11', 'Civil', 'Water Dispenser', '29', 'Filter Cleaning', 'Dhanushka, Harshana', 'PMD', 'mont', '', '27', '2025-06-30 00:00:00', 0),
(44, '2025-02-09 08:19:18', '11', 'Civil', 'Water Dispenser', '29', 'Filter Cleaning', 'Dhanushka, Harshana', 'PMD', 'mont', '', '32', '2025-08-04 00:00:00', 0),
(45, '2025-02-09 08:19:18', '11', 'Civil', 'Water Dispenser', '29', 'Filter Cleaning', 'Dhanushka, Harshana', 'PMD', 'mont', '', '37', '2025-09-08 00:00:00', 0),
(46, '2025-02-09 08:19:18', '11', 'Civil', 'Water Dispenser', '29', 'Filter Cleaning', 'Dhanushka, Harshana', 'PMD', 'mont', '', '42', '2025-10-13 00:00:00', 0),
(47, '2025-02-09 08:19:18', '11', 'Civil', 'Water Dispenser', '29', 'Filter Cleaning', 'Dhanushka, Harshana', 'PMD', 'mont', '', '47', '2025-11-17 00:00:00', 0),
(48, '2025-02-09 08:19:18', '12', 'Civil', 'Water Tank', '6', 'Tank Cleaning, Painting inside', 'Dhanushka, Harshana', 'PMD', '6 mo', 'factory shutdown', '15', '2025-04-07 00:00:00', 0),
(49, '2025-02-09 08:19:18', '12', 'Civil', 'Water Tank', '6', 'Tank Cleaning, Painting inside', 'Dhanushka, Harshana', 'PMD', '6 mo', 'factory shutdown', '51', '2025-12-15 00:00:00', 0),
(50, '2025-02-09 08:19:18', '13', 'Civil', 'Water leak test reports ', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '3', '2025-01-13 00:00:00', 0),
(51, '2025-02-09 08:19:18', '13', 'Civil', 'Water leak test reports ', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '7', '2025-02-10 00:00:00', 0),
(52, '2025-02-09 08:19:18', '13', 'Civil', 'Water leak test reports ', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '12', '2025-03-17 00:00:00', 0),
(53, '2025-02-09 08:19:18', '13', 'Civil', 'Water leak test reports ', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '17', '2025-04-21 00:00:00', 0),
(54, '2025-02-09 08:19:18', '13', 'Civil', 'Water leak test reports ', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '22', '2025-05-26 00:00:00', 0),
(55, '2025-02-09 08:19:18', '13', 'Civil', 'Water leak test reports ', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '27', '2025-06-30 00:00:00', 0),
(56, '2025-02-09 08:19:18', '13', 'Civil', 'Water leak test reports ', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '32', '2025-08-04 00:00:00', 0),
(57, '2025-02-09 08:19:18', '13', 'Civil', 'Water leak test reports ', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '37', '2025-09-08 00:00:00', 0),
(58, '2025-02-09 08:19:18', '13', 'Civil', 'Water leak test reports ', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '42', '2025-10-13 00:00:00', 0),
(59, '2025-02-09 08:19:18', '13', 'Civil', 'Water leak test reports ', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '47', '2025-11-17 00:00:00', 0),
(60, '2025-02-09 08:19:18', '14', 'Civil', 'Water flow rate  for water using equipments. ( Site -01,02,0', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '1', '2024-12-30 00:00:00', 0),
(61, '2025-02-09 08:19:18', '14', 'Civil', 'Water flow rate  for water using equipments. ( Site -01,02,0', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '5', '2025-01-27 00:00:00', 0),
(62, '2025-02-09 08:19:18', '14', 'Civil', 'Water flow rate  for water using equipments. ( Site -01,02,0', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '9', '2025-02-24 00:00:00', 0),
(63, '2025-02-09 08:19:18', '14', 'Civil', 'Water flow rate  for water using equipments. ( Site -01,02,0', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '13', '2025-03-24 00:00:00', 0),
(64, '2025-02-09 08:19:18', '14', 'Civil', 'Water flow rate  for water using equipments. ( Site -01,02,0', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '18', '2025-04-28 00:00:00', 0),
(65, '2025-02-09 08:19:18', '14', 'Civil', 'Water flow rate  for water using equipments. ( Site -01,02,0', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '22', '2025-05-26 00:00:00', 0),
(66, '2025-02-09 08:19:18', '14', 'Civil', 'Water flow rate  for water using equipments. ( Site -01,02,0', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '27', '2025-06-30 00:00:00', 0),
(67, '2025-02-09 08:19:18', '14', 'Civil', 'Water flow rate  for water using equipments. ( Site -01,02,0', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '32', '2025-08-04 00:00:00', 0),
(68, '2025-02-09 08:19:18', '14', 'Civil', 'Water flow rate  for water using equipments. ( Site -01,02,0', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '37', '2025-09-08 00:00:00', 0),
(69, '2025-02-09 08:19:18', '14', 'Civil', 'Water flow rate  for water using equipments. ( Site -01,02,0', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '41', '2025-10-06 00:00:00', 0),
(70, '2025-02-09 08:19:18', '14', 'Civil', 'Water flow rate  for water using equipments. ( Site -01,02,0', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '45', '2025-11-03 00:00:00', 0),
(71, '2025-02-09 08:19:18', '14', 'Civil', 'Water flow rate  for water using equipments. ( Site -01,02,0', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '49', '2025-12-01 00:00:00', 0),
(72, '2025-02-09 08:19:18', '14', 'Civil', 'Water flow rate  for water using equipments. ( Site -01,02,0', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '51', '2025-12-15 00:00:00', 0),
(73, '2025-02-09 08:19:18', '15', 'Civil', 'Rooler Door Service', '', '', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '5', '2025-01-27 00:00:00', 0),
(74, '2025-02-09 08:19:18', '15', 'Civil', 'Rooler Door Service', '', '', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '18', '2025-04-28 00:00:00', 0),
(75, '2025-02-09 08:19:18', '15', 'Civil', 'Rooler Door Service', '', '', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '31', '2025-07-28 00:00:00', 0),
(76, '2025-02-09 08:19:18', '15', 'Civil', 'Rooler Door Service', '', '', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '44', '2025-10-27 00:00:00', 0),
(77, '2025-02-09 08:19:18', '16', 'Civil', 'Fence Painting', '', 'paint', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '4', '2025-01-20 00:00:00', 0),
(78, '2025-02-09 08:19:18', '16', 'Civil', 'Fence Painting', '', 'paint', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '16', '2025-04-14 00:00:00', 0),
(79, '2025-02-09 08:19:18', '16', 'Civil', 'Fence Painting', '', 'paint', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '30', '2025-07-21 00:00:00', 0),
(80, '2025-02-09 08:19:18', '16', 'Civil', 'Fence Painting', '', 'paint', 'Dhanushka, Harshana', 'PMD', '3 mo', '', '43', '2025-10-20 00:00:00', 0),
(81, '2025-02-09 08:19:18', '17', 'Civil', 'Paint - b m, 5s - in side', '', 'paint', 'Dhanushka, Harshana', 'PMD', '6 mo', '', '15', '2025-04-07 00:00:00', 0),
(82, '2025-02-09 08:19:18', '17', 'Civil', 'Paint - b m, 5s - in side', '', 'paint', 'Dhanushka, Harshana', 'PMD', '6 mo', '', '51', '2025-12-15 00:00:00', 0),
(83, '2025-02-09 08:19:18', '26', 'Civil', 'Paint - 03 rd floor, 5s - out side', '', 'paint', 'Dhanushka, Harshana', 'PMD', '6 mo', '', '6', '2025-02-03 00:00:00', 1),
(84, '2025-02-09 08:19:18', '40', 'Civil', 'Paint - Pro , J2, 2S - Out side', '', 'paint', 'Dhanushka, Harshana', 'PMD', '6 mo', '', '6', '2025-02-03 00:00:00', 1),
(85, '2025-02-09 08:19:18', '89', 'Civil', 'Water  consumption - BOI Main meters', '', 'Reports', 'Dhanushka, Harshana', 'PMD', 'Mont', '', '6', '2025-02-03 00:00:00', 1),
(86, '2025-02-09 08:19:18', '96', 'Electrical', ' FIRE SOUNDER ,S4', '', '', 'Tharidu', 'PMD', 'mont', '', '4', '2025-01-20 00:00:00', 0),
(87, '2025-02-09 08:19:18', '96', 'Electrical', ' FIRE SOUNDER ,S4', '', '', 'Tharidu', 'PMD', 'mont', '', '8', '2025-02-17 00:00:00', 0),
(88, '2025-02-09 08:19:18', '96', 'Electrical', ' FIRE SOUNDER ,S4', '', '', 'Tharidu', 'PMD', 'mont', '', '12', '2025-03-17 00:00:00', 0),
(89, '2025-02-09 08:19:18', '96', 'Electrical', ' FIRE SOUNDER ,S4', '', '', 'Tharidu', 'PMD', 'mont', '', '16', '2025-04-14 00:00:00', 0),
(90, '2025-02-09 08:19:18', '96', 'Electrical', ' FIRE SOUNDER ,S4', '', '', 'Tharidu', 'PMD', 'mont', '', '20', '2025-05-12 00:00:00', 0),
(91, '2025-02-09 08:19:18', '96', 'Electrical', ' FIRE SOUNDER ,S4', '', '', 'Tharidu', 'PMD', 'mont', '', '24', '2025-06-09 00:00:00', 0),
(92, '2025-02-09 08:19:18', '96', 'Electrical', ' FIRE SOUNDER ,S4', '', '', 'Tharidu', 'PMD', 'mont', '', '28', '2025-07-07 00:00:00', 0),
(93, '2025-02-09 08:19:18', '96', 'Electrical', ' FIRE SOUNDER ,S4', '', '', 'Tharidu', 'PMD', 'mont', '', '32', '2025-08-04 00:00:00', 0),
(94, '2025-02-09 08:19:18', '96', 'Electrical', ' FIRE SOUNDER ,S4', '', '', 'Tharidu', 'PMD', 'mont', '', '36', '2025-09-01 00:00:00', 0),
(95, '2025-02-09 08:19:18', '96', 'Electrical', ' FIRE SOUNDER ,S4', '', '', 'Tharidu', 'PMD', 'mont', '', '40', '2025-09-29 00:00:00', 0),
(96, '2025-02-09 08:19:18', '96', 'Electrical', ' FIRE SOUNDER ,S4', '', '', 'Tharidu', 'PMD', 'mont', '', '44', '2025-10-27 00:00:00', 0),
(97, '2025-02-09 08:19:18', '96', 'Electrical', ' FIRE SOUNDER ,S4', '', '', 'Tharidu', 'PMD', 'mont', '', '48', '2025-11-24 00:00:00', 0),
(98, '2025-02-09 08:19:18', '96', 'Electrical', ' FIRE SOUNDER ,S4', '', '', 'Tharidu', 'PMD', 'mont', '', '52', '2025-12-22 00:00:00', 0),
(99, '2025-02-09 08:19:18', '98', 'Electrical', 'Manual Call Point Check - waliweriya', '', '', 'Tharidu', 'PMD', 'mont', '', '6', '2025-02-03 00:00:00', 1),
(100, '2025-02-09 08:19:18', '103', 'Electrical', 'Pump Room-S1', '', '', 'Tharidu', 'PMD', 'mont', '', '6', '2025-02-03 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test`
--

CREATE TABLE `tbl_test` (
  `id` int(11) NOT NULL,
  `assigned_mechanics` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_test`
--

INSERT INTO `tbl_test` (`id`, `assigned_mechanics`) VALUES
(1, 'John, Jane, Bob'),
(2, 'Alice, Charlie'),
(3, 'David');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblusers_account`
--
ALTER TABLE `tblusers_account`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EPF` (`EPF`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- Indexes for table `tblusers_roleaccess`
--
ALTER TABLE `tblusers_roleaccess`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserType` (`UserType`);

--
-- Indexes for table `tblworkcentersetting_twl`
--
ALTER TABLE `tblworkcentersetting_twl`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblwo_allcheckinusers`
--
ALTER TABLE `tblwo_allcheckinusers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblwo_allocatedusers`
--
ALTER TABLE `tblwo_allocatedusers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblwo_event`
--
ALTER TABLE `tblwo_event`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblwo_masterdata_breakdown`
--
ALTER TABLE `tblwo_masterdata_breakdown`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblwo_masterdata_redtag`
--
ALTER TABLE `tblwo_masterdata_redtag`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblwo_masterdata_service`
--
ALTER TABLE `tblwo_masterdata_service`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_test`
--
ALTER TABLE `tbl_test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblusers_account`
--
ALTER TABLE `tblusers_account`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=808;

--
-- AUTO_INCREMENT for table `tblusers_roleaccess`
--
ALTER TABLE `tblusers_roleaccess`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblworkcentersetting_twl`
--
ALTER TABLE `tblworkcentersetting_twl`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblwo_allcheckinusers`
--
ALTER TABLE `tblwo_allcheckinusers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblwo_allocatedusers`
--
ALTER TABLE `tblwo_allocatedusers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3152;

--
-- AUTO_INCREMENT for table `tblwo_event`
--
ALTER TABLE `tblwo_event`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8090;

--
-- AUTO_INCREMENT for table `tblwo_masterdata_breakdown`
--
ALTER TABLE `tblwo_masterdata_breakdown`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `tblwo_masterdata_redtag`
--
ALTER TABLE `tblwo_masterdata_redtag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `tblwo_masterdata_service`
--
ALTER TABLE `tblwo_masterdata_service`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

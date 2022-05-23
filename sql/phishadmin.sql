-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
-- first dump
-- 
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2020 at 10:16 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phishadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(1) NOT NULL,
  `username` varchar(20) NOT NULL,
  `passcode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `passcode`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `empid` int(50) NOT NULL,
  `testcode` varchar(50) NOT NULL,
  `ansgiven` varchar(50) NOT NULL,
  `actualans` varchar(50) NOT NULL,
  `mode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `testcode` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `valid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `testcode` varchar(50) NOT NULL,
  `empid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invite`
--

CREATE TABLE `invite` (
  `username` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `testcode` varchar(50) NOT NULL,
  `orgname` varchar(50) NOT NULL,
  `orgdomain` varchar(50) NOT NULL,
  `finaldomain` varchar(50) NOT NULL,
  `url` varchar(200) NOT NULL,
  `emailid` varchar(30) NOT NULL,
  `email` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questionsdb`
--

CREATE TABLE `questionsdb` (
  `questionid` int(11) NOT NULL,
  `question` varchar(5000) NOT NULL,
  `mode` varchar(200) NOT NULL,
  `posneg` varchar(20) NOT NULL,
  `type` varchar(100) NOT NULL,
  `emailheading` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questionsdb`
--

INSERT INTO `questionsdb` (`questionid`, `question`, `mode`, `posneg`, `type`, `emailheading`) VALUES
(1, '*This is an automated email*\r\n\r\nOur regulators require we monitor and restrict certain website access due to content. The filter system flagged your computer as one that has viewed or logged into websites hosting restricted content. The system is not full-proof, and may incorrectly flag restricted content. The IT department does not investigate every web filter report, but disciplinary action may be taken.\r\nLog into the filter system with your network credentials immediately and review your logs to see which websites triggered this alert.\r\n<a href=\'https://bit.ly/KG1k4t\'>Web Security Logs</a>\r\n\r\n-----\r\nDo not reply to this email. This email was automatically generated to inform you of a violation of our security and content policies.\r\nRegards,\r\nIT Helpdesk', 'link', 'neg', 'IT', 'Unauthorized Web Site Access'),
(2, 'Dear All,\r\n\r\nThe staff manual for employees for the period 1st January 2019 to 31st March 2020 has been renewed with significant benefit enhancements this year.\r\nThe revised Policy offer you and your family comprehensive benefits.\r\nTo avail the benefits please accept the agreement <a href=\'https://goo.gl/rxozgv\'>here</a>.\r\nRegards,\r\nHuman Resource', 'link', 'neg', 'HR', 'Urgent - Employee Policy Updated'),
(3, '*This is an automated email*\r\n\r\nThe last date for tax proof submission was March 18, 2019.\r\nHowever, you have not submitted the tax proof on the portal yet. Please <a href=\'\'>click here</a> for the way forward.\r\nRegards,\r\nHuman Resource\r\n', 'link', 'neg', 'HR', 'Urgent - Non-compliance tax proof submission'),
(4, 'Dear User,\r\nYour primary phone number was setup or changed yesterday.\r\nYour security is important for us. If you did not authorize this change, please contact us immediately.\r\nRegards,\r\nHuman Resource\r\n', 'email', 'neg', 'HR', 'Urgent - Phone number updated'),
(5, 'Dear All,\r\n\r\nThe Health Insurance Policy for employees and family members for the period 1st January 2019 to 31st March 2020 has been renewed with significant benefit enhancements this year.\r\nThe benefits under the new Health Insurance Policy offers you and your family a very comprehensive coverage program.\r\nDependent Declaration :\r\nEmployees who have declared their dependents in last year policy period would be required  to check and re-validate the same by providing the below information.\r\nName:\r\nEmployee ID:\r\nDependent Name:\r\nDOB:\r\nRelation:\r\nNo discrepancy would be accepted in this at a later stage as per insurance norms. No additions / amendments will be allowed after 18th August 2019.\r\nStay fit , Stay healthy !!\r\n', 'email', 'neg', 'HR', 'Update dependent data'),
(6, 'Your Domain (Network/VPN) password will expire in 2 day(s).\r\nYou can change your password from <a href=\'\'>here</a> \r\n\r\nOnce signed into your account, you can click your User Name in the upper right corner and select \'Settings\'. \r\n\r\nFrom here, you can click \'Edit Profile\' and change your Domain password if it is about to expire. \r\n\r\nPlease contact ithelp if you need further assistance or your account is locked.', 'link', 'neg', 'IT', 'Password expiration notice - 2 day(s) left'),
(7, '*This is an automated email*\r\n\r\nYou are currently running on low GB due to hidden files and folders on your mailbox, Please click here - <a href=\'\'>http://to.ly/aZTw</a> to create more space on your mailbox and increase your quota.\r\n\r\nRegards,\r\nIT Helpdesk', 'link', 'neg', 'IT', 'Disk Usage Alert!'),
(8, 'I used Dropbox to share a file with you\r\n\r\nClick <a href=\'\'>here</a> to view\r\n\r\n©2019 Dropbox Inc', 'link', 'neg', 'IT', 'Dropbox: Shared A File With You'),
(9, '*This is an automated email*\r\n\r\nYour previous One drive email attachment was failed to deliver.\r\n \r\nPlease download the attached file again.\r\n', 'attachment', 'neg', 'IT', 'Alert: Attachment failed'),
(10, 'Hello Team,\r\n\r\nInteresting read, Do not miss!\r\n\r\n<a href=\'\'>http://bit.ly/1sNZMqL+</a>\r\n\r\nThanks!', 'link', 'neg', 'IT', 'Interesting Read!'),
(11, 'You have received a secure document via Dropbox.\r\nPlease find attached.\r\n\r\nLet us know in case of issues.\r\n\r\nRegards,\r\nIT Helpdesk', 'attachment', 'neg', 'IT', 'Secure Attachment '),
(12, 'Dear All,\r\n\r\nWe are having an interesting talk on \'Time Management\' from Mr. Rob Mart in a next 5 minutes.\r\nJoin the webex now:\r\n<a href=\'\'>\r\nhttps://cisco.webex.com/team/j.php?MTID=m630a7v3ce0617f1b44hec8299b0eec</a>', 'link', 'neg', 'IT', 'Join now!!'),
(13, '*This is an automated email*\r\n\r\nOur regulators require we monitor and restrict certain website access due to content. The filter system flagged your computer as one that has viewed or logged into websites hosting restricted content. The system is not full-proof, and may incorrectly flag restricted content. The IT department does not investigate every web filter report, but disciplinary action may be taken.\r\nLog into the filter system with your network credentials immediately and review your logs to see which websites triggered this alert.\r\n<a href=\'\'>Web Security Logs</a>\r\n-----\r\nDo not reply to this email. This email was automatically generated to inform you of a violation of our security and content policies.\r\nRegards,\r\nIT Helpdesk', 'link', 'pos', 'IT', 'Unauthorized Web Site Access'),
(14, 'Dear All,\r\n\r\nThe staff manual for employees for the period 1st January 2019 to 31st March 2020 has been renewed with significant benefit enhancements this year.\r\nThe revised Policy offer you and your family comprehensive benefits.\r\nTo avail the benefits please accept the agreement <a href=\'\'>here</a>.\r\nRegards,\r\nHuman Resource', 'link', 'pos', 'HR', 'Urgent - Employee Policy Updated'),
(15, '*This is an automated email*\r\n\r\nThe last date for tax proof submission was March 18, 2019.\r\nHowever, you have not submitted the tax proof on the portal yet. Please <a href=\'\'>click here<a> for the way forward.\r\nRegards,\r\nHuman Resource\r\n', 'link', 'pos', 'HR', 'Urgent - Non-compliance tax proof submission'),
(16, 'Dear User,\r\nYour primary phone number was setup or changed yesterday.\r\nYour security is important for us. If you did not authorize this change, please contact us immediately.\r\nRegards,\r\nHuman Resource\r\n', 'email', 'pos', 'HR', 'Urgent - Phone number updated'),
(17, 'Dear All,\r\n\r\nThe Health Insurance Policy for employees and family members for the period 1st January 2019 to 31st March 2020 has been renewed with significant benefit enhancements this year.\r\nThe benefits under the new Health Insurance Policy offers you and your family a very comprehensive coverage program.\r\nDependent Declaration :\r\nEmployees who have declared their dependents in last year policy period would be required  to check and re-validate the same by providing the below information.\r\nName:\r\nEmployee ID:\r\nDependent Name:\r\nDOB:\r\nRelation:\r\nNo discrepancy would be accepted in this at a later stage as per insurance norms. No additions / amendments will be allowed after 18th January 2020.\r\nStay fit , Stay healthy !!\r\n', 'email', 'pos', 'HR', 'Update dependent data'),
(18, 'Your Domain (Network/VPN) password will expire in 2 day(s).\r\nPlease change your password ASAP. \r\n\r\nOnce signed into your account, you can click your User Name in the upper right corner and select \'Settings\'. \r\n\r\nFrom here, you can click \'Edit Profile\' and change your Domain password if it is about to expire. \r\n\r\nPlease contact ithelp if you need further assistance or your account is locked.', 'link', 'pos', 'IT', 'Password expiration notice - 2 day(s) left'),
(19, 'Hello Team,\r\n\r\nInteresting read, Do not miss!\r\n<a href=\'\'>\r\nhttps://en.wikipedia.org/wiki/Cloud_computing</a>\r\n\r\nThanks!', 'link', 'pos', 'IT', 'Interesting Read!'),
(20, 'Dear All,\r\n\r\nWe are proud to share this report of our  current market place and new upcoming products, please have a look.\r\n\r\nEvery effort counts!\r\n\r\nThanks\r\nTeam Markets', 'attachment', 'pos', 'HR', 'We are growing!'),
(21, 'We are pleased to inform you that our CEO will be meeting all of you on Monday.\r\n\r\nPlease join us in welcoming him at an all-hands meet and understand his vision.\r\n\r\nIt will be followed by lunch, please click <a href=\'\'>here</a> for your confirmation.\r\n\r\nRegards,\r\nTeam HR ', 'link', 'pos', 'HR', 'You are invited'),
(22, 'You have one mail message which has been quarantined due to security reasons.\r\n\r\nIf you feel the mail is from valid recipient please <a href=\'http://adf.ly/rlypw\'>click here</a>.\r\n\r\nRegards,\r\nIT Helpdesk', 'link', 'neg', 'IT', 'You have one unread email!'),
(23, 'Dear All,\r\n\r\nWe will be doing a mock fire drill on Friday, 3.00 PM.\r\nRequest you all to evacuate the office space once alarmed and follow the instructions.\r\n\r\nThanks in anticipation,\r\nTeam Admin', 'link', 'pos', 'HR', 'Mock fire drill'),
(24, 'Dear User,\r\n\r\nRecovery details associated with your account has been tampered with.\r\n\r\nWe presume this may be an account-takeover action by someone else.\r\n\r\nClarify if your aware of this change by checking below/replying on this email.\r\n\r\n<a href=\'\'>here</a>\r\n\r\nThanks\r\nIT Helpdesk', 'link', 'pos', 'IT', 'Your Email Account is at Risk');

-- --------------------------------------------------------

--
-- Table structure for table `testdb`
--

CREATE TABLE `testdb` (
  `testcode` varchar(50) NOT NULL,
  `empid` int(20) NOT NULL,
  `questionid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tutorial`
--

CREATE TABLE `tutorial` (
  `pageno` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tutorial`
--

INSERT INTO `tutorial` (`pageno`, `title`, `data`) VALUES
(2, 'what is phishing?', 'Phishing is a form of fraud in which a person or group of people are contacted by email, telephone or text message by someone posing as a legitimate organization to tempt individuals into providing sensitive data such as <span style=\"font-size:18px;color:red;\"><b><i>PII & SPI</span></b></i> (Personally Identifiable Information/Sensitive Personal Information), passwords or banking and credit card details.\r\n\r\nThe information is then used to access important accounts and can result in identity theft and financial loss.\r\n\r\nPhishing is an example of social engineering techniques being used to deceive users.\r\n\r\nPhishing is popular with cyber criminals, as the people remains weakest link of the organization and it is far more easier than trying to break the computer network defenses.'),
(3, 'What damage it does?', 'The dangers of being phished are endless. \r\n\r\nSuccessful phishing involves the scammer gaining unauthorized access to an organization\'s <span style=\"font-size:18px;color:red;\"><b><i>private information</span></b></i>, which they then use adversely.\r\n\r\nThey often also target <span style=\"font-size:18px;color:red;\"><b><i>financial information</span></b></i> such as bank account details to cause a financial damage to organization or person.\r\n\r\nOrganization may also suffer from reputation damage, they may be seen as incompetent and untrustworthy\r\n\r\nA successful phishing attack can also be used as base to close down access of the important systems and demand ransom.\r\n'),
(4, 'Why you should know it?', 'Since it leverages <i><b><span style=\"font-size:18px;color:red;\">weaknesses in human interfaces</span></b></i> it gives scale and the ability to go after hundreds or thousands of users - all at once.\r\n\r\nAll it take is just <i><b><span style=\"font-size:18px;color:red;\">one click</span></b></i> to damage entire organization or take a financial loss to self.\r\n\r\nPhishing accounted for <i><b><span style=\"font-size:18px;color:red;\">71%</span></b></i> of all targeted cyber attacks in 2017. In 2018, the number of phishing attacks rose by <i><b><span style=\"font-size:18px;color:red;\">27.5%</span></b></i>to reach over 137 million.\r\n\r\nWhile it is one of the oldest tricks that a threat actor can use, it is still one of the easiest ways to gain access to a system.\r\n\r\nIts all about hacking the human.'),
(5, 'Techniques', '<i><b><span style=\"font-size:18px;color:red;\">Spear phishing</span></b></i> attacks are directed at specific individuals or companies usually using information which is very specific to victim to look like more authentic.\r\n\r\n<i><b><span style=\"font-size:18px;color:red;\">Pharming</span></b></i> is a type of phishing that depends on DNS cache poisoning to redirect users from a legitimate site to a fraudulent one.\r\n\r\n<i><b><span style=\"font-size:18px;color:red;\">Clone phishing</span></b></i> attack use previously delivered, but legitimate emails that contain either a link or attachment. Attackers make a copy/clone of the legitimate email, replacing link with malicious link and attachments with malware attachments \r\n\r\nPhishers also use <i><b><span style=\"font-size:18px;color:red;\">evil twin</span></b></i> Wi-Fi attack by creating a rogue access point and advertising it with a deceptive name that look like legitimate.\r\n\r\n<i><b><span style=\"font-size:18px;color:red;\">Voice phishing</span></b></i> or vishing that occurs over voice communication media including VoIP or telephone service'),
(6, 'Techniques', '<i><b><span style=\"font-size:18px;color:red;\">SMS phishing</span></b></i> uses text messaging to convince victims to disclose sensitive information\r\n\r\nPhishing campaigns generally use one or more of a variety of <i><b><span style=\"font-size:18px;color:red;\">link manipulation</span></b></i> techniques - such as URL hiding or link shortening or homograph spoofing in which URLs are created using different logical characters to read exactly like trusted domain to trick victims into clicking.\r\n \r\nAnother phishing tactic relies on a <i><b><span style=\"font-size:18px;color:red;\">covert redirect</span></b></i>, where an open redirect vulnerability fails to check that a redirected URL is pointing to a trusted resource. In that case, the redirected URL is an intermediate, malicious page which solicits authentication information from the victim before forwarding the victim\'s browser to the legitimate site.\r\n'),
(7, 'Stop being victim, be attentive!', 'Always ensure that Check that the Web page you visit is a secure site. The web address must begin with <i><b><span style=\"font-size:18px;color:red;\">https://</span></b></i> and a little closed padlock must be displayed on the status bar of the browser.\r\n\r\nDo not forget to click on padlock and <i><b><span style=\"font-size:18px;color:red;\">view the certificate</span></b></i>, make sure it is issued by valid certificate authority, issued to the website you are visiting and is not expired.\r\n\r\nCheck the source of information received.\r\n\r\nDon\'t reply to any email message that asks for your personal or financial information.\r\n\r\nDo not download attachments with possibly dangerous file type, observe the email id from which you are receiving mail.\r\n\r\n<i><b><span style=\"font-size:18px;color:red;\">Think before you click!</span></b></i> - When you receive links via email, hover over it and ensure they lead where they are supposed to lead? \r\n\r\nKeep Your Browser Up to Date - Security patches are released in response to security loop holes that attackers exploit.\r\n\r\nIf you see such emails do not just ignore, <i><b><span style=\"font-size:18px;color:red;\">Report!</span></b></i>\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionsdb`
--
ALTER TABLE `questionsdb`
  ADD PRIMARY KEY (`questionid`);

--
-- Indexes for table `tutorial`
--
ALTER TABLE `tutorial`
  ADD PRIMARY KEY (`pageno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

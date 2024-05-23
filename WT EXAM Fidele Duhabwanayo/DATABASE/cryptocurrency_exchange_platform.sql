-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 11:24 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cryptocurrency_exchange_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `cryptocurrencies`
--

CREATE TABLE `cryptocurrencies` (
  `CryptocurrencyID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Symbol` varchar(10) NOT NULL,
  `Description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cryptocurrencies`
--

INSERT INTO `cryptocurrencies` (`CryptocurrencyID`, `Name`, `Symbol`, `Description`) VALUES
(1, 'USD', '$', 'US Dolar'),
(2, 'Rwanda', 'RWF', 'Rwandan Francs'),
(4, 'yemen', '#', 'Amercan');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `DepositID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Amount` decimal(20,8) NOT NULL,
  `DepositDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`DepositID`, `UserID`, `Amount`, `DepositDate`) VALUES
(1, 4, '1000.00000000', '2024-05-18 22:00:00'),
(2, 4, '2000.00000000', '2024-05-18 22:00:00'),
(3, 4, '33333234.00000000', '2024-05-20 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `marketdata`
--

CREATE TABLE `marketdata` (
  `MarketDataID` int(11) NOT NULL,
  `CryptocurrencyID` int(11) DEFAULT NULL,
  `Price` decimal(20,8) NOT NULL,
  `Volume` decimal(20,8) NOT NULL,
  `MarketCap` decimal(20,8) NOT NULL,
  `LastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marketdata`
--

INSERT INTO `marketdata` (`MarketDataID`, `CryptocurrencyID`, `Price`, `Volume`, `MarketCap`, `LastUpdated`) VALUES
(1, 1, '4000.00000000', '34567.00000000', '4566778.00000000', '2024-05-20 22:00:00'),
(2, 1, '5000.00000000', '23445556.00000000', '344566.00000000', '2024-05-20 22:00:00'),
(4, 1, '5000.00000000', '234.00000000', '344566.00000000', '2024-05-20 22:00:00'),
(5, 1, '5000.00000000', '234.00000000', '344566.00000000', '2024-05-20 22:00:00'),
(6, 1, '5000.00000000', '234.00000000', '344566.00000000', '2024-05-20 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Message` text NOT NULL,
  `IsRead` tinyint(1) DEFAULT '0',
  `NotificationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tradehistory`
--

CREATE TABLE `tradehistory` (
  `HistoryID` int(11) NOT NULL,
  `TradeID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CryptocurrencyID` int(11) DEFAULT NULL,
  `TradeType` enum('Buy','Sell') DEFAULT NULL,
  `Amount` decimal(20,8) NOT NULL,
  `Price` decimal(20,8) NOT NULL,
  `TradeDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tradehistory`
--

INSERT INTO `tradehistory` (`HistoryID`, `TradeID`, `UserID`, `CryptocurrencyID`, `TradeType`, `Amount`, `Price`, `TradeDate`) VALUES
(2, 4, 4, 1, '', '1000.00000000', '5000.00000000', '2024-05-18 22:00:00'),
(3, 4, 4, 1, '', '1000.00000000', '5000.00000000', '2024-05-18 22:00:00'),
(4, 4, 4, 1, '', '1000.00000000', '5000.00000000', '2024-05-18 22:00:00'),
(5, 4, 4, 1, '', '1000.00000000', '5000.00000000', '2024-05-18 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE `trades` (
  `TradeID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CryptocurrencyID` int(11) DEFAULT NULL,
  `TradeType` enum('Buy','Sell') DEFAULT NULL,
  `Amount` decimal(20,8) NOT NULL,
  `Price` decimal(20,8) NOT NULL,
  `TradeDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trades`
--

INSERT INTO `trades` (`TradeID`, `UserID`, `CryptocurrencyID`, `TradeType`, `Amount`, `Price`, `TradeDate`) VALUES
(2, 4, 1, 'Buy', '1000.00000000', '5000.00000000', '2024-05-20 22:00:00'),
(3, 4, 1, 'Buy', '3000.00000000', '5000.00000000', '2024-05-20 22:00:00'),
(4, 4, 1, 'Buy', '1000.00000000', '5000.00000000', '2024-05-20 22:00:00'),
(6, 4, 1, 'Buy', '7000.00000000', '4000.00000000', '2024-05-20 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'Fidele', 'Duhabwanayo', '222003029', 'fideleduhabwanayo49@gmail.com', '0784150155', '$2y$10$9faNXq4xqCJ0.k/0PWEFweqX69XaldI5rcdCUjaeRnWL1YSnl2L6C', '2024-05-20 22:00:00', '1234', 0),
(2, 'Fidele', 'Duhabwanayo', '222003029', 'fideleduhabwanayo49@gmail.com', '0784150155', '$2y$10$vjwC7DdL74qKbonhEFT7y.khgQRnou.WYcIG01iUUz7lXeEQ4nLlO', '2024-05-20 22:00:00', '1234', 0),
(3, 'Fidele', 'Duhabwanayo', '222003029', 'fideleduhabwanayo49@gmail.com', '0784150155', '$2y$10$c4zutmMQXVORQAjm4P/WrOSTmP3Bwg8jf8AxLeY7XGheNY/bCa6be', '2024-05-21 22:00:00', '1234', 0),
(4, 'sdfghj', 'dfghjm,', '222003029', 'fideleduhabwanayo49@gmail.com', '0784150155', '1234', '2024-05-08 22:00:00', '1234', 0),
(5, 'sdfghj', 'dfghjm,', '222003029', 'fideleduhabwanayo49@gmail.com', '0784150155', '1234', '2024-05-08 22:00:00', '1234', 0),
(6, 'Fidele', 'D.F', '222003029', 'fideleduhabwanayo49@gmail.com', '0737198207', '1234', '0000-00-00 00:00:00', '1234', 0),
(8, 'Fidele', 'Duhabwanayo', '222003029', 'fideleduhabwanayo49@gmail.com', '0784150155', '222003029', '2024-05-22 22:00:00', '1234', 0),
(10, 'Fidele', 'Duhabwanayo', '222003029', 'fideleduhabwanayo49@gmail.com', '0784150155', '1234', '2024-05-21 22:00:00', '1234', 0),
(11, 'Fidele', 'Duhabwanayo', '222003029', 'fideleduhabwanayo49@gmail.com', '0784150155', '12345', '2024-05-21 22:00:00', '1234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usersettings`
--

CREATE TABLE `usersettings` (
  `SettingID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `SettingName` varchar(50) NOT NULL,
  `SettingValue` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersettings`
--

INSERT INTO `usersettings` (`SettingID`, `UserID`, `SettingName`, `SettingValue`) VALUES
(1, 4, 'User', 'money'),
(2, 4, 'Emmy', '725'),
(3, 4, 'Market', 'money'),
(5, 4, 'User', 'money'),
(6, 4, 'User', '725'),
(7, 4, 'User', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `WalletID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CryptocurrencyID` int(11) DEFAULT NULL,
  `Balance` decimal(20,8) DEFAULT '0.00000000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`WalletID`, `UserID`, `CryptocurrencyID`, `Balance`) VALUES
(1, 4, 1, '154300.00000000'),
(3, 4, 1, '5000432000.00000000'),
(4, 4, 1, '38700.00000000');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `WithdrawalID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Amount` decimal(20,8) NOT NULL,
  `WithdrawalDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`WithdrawalID`, `UserID`, `Amount`, `WithdrawalDate`) VALUES
(1, 4, '1000.00000000', '2024-05-13 22:00:00'),
(3, 5, '4000.00000000', '2024-05-13 22:00:00'),
(4, 5, '4000.00000000', '2024-05-13 22:00:00'),
(5, 5, '4000.00000000', '2024-05-13 22:00:00'),
(6, 5, '65000.00000000', '2024-05-20 22:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cryptocurrencies`
--
ALTER TABLE `cryptocurrencies`
  ADD PRIMARY KEY (`CryptocurrencyID`),
  ADD UNIQUE KEY `Symbol` (`Symbol`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`DepositID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `marketdata`
--
ALTER TABLE `marketdata`
  ADD PRIMARY KEY (`MarketDataID`),
  ADD KEY `CryptocurrencyID` (`CryptocurrencyID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tradehistory`
--
ALTER TABLE `tradehistory`
  ADD PRIMARY KEY (`HistoryID`),
  ADD KEY `TradeID` (`TradeID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CryptocurrencyID` (`CryptocurrencyID`);

--
-- Indexes for table `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`TradeID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CryptocurrencyID` (`CryptocurrencyID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `usersettings`
--
ALTER TABLE `usersettings`
  ADD PRIMARY KEY (`SettingID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`WalletID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CryptocurrencyID` (`CryptocurrencyID`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`WithdrawalID`),
  ADD KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cryptocurrencies`
--
ALTER TABLE `cryptocurrencies`
  MODIFY `CryptocurrencyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `DepositID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marketdata`
--
ALTER TABLE `marketdata`
  MODIFY `MarketDataID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tradehistory`
--
ALTER TABLE `tradehistory`
  MODIFY `HistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
  MODIFY `TradeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usersettings`
--
ALTER TABLE `usersettings`
  MODIFY `SettingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `WalletID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `WithdrawalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `marketdata`
--
ALTER TABLE `marketdata`
  ADD CONSTRAINT `marketdata_ibfk_1` FOREIGN KEY (`CryptocurrencyID`) REFERENCES `cryptocurrencies` (`CryptocurrencyID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `tradehistory`
--
ALTER TABLE `tradehistory`
  ADD CONSTRAINT `tradehistory_ibfk_1` FOREIGN KEY (`TradeID`) REFERENCES `trades` (`TradeID`),
  ADD CONSTRAINT `tradehistory_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `tradehistory_ibfk_3` FOREIGN KEY (`CryptocurrencyID`) REFERENCES `cryptocurrencies` (`CryptocurrencyID`);

--
-- Constraints for table `trades`
--
ALTER TABLE `trades`
  ADD CONSTRAINT `trades_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `trades_ibfk_2` FOREIGN KEY (`CryptocurrencyID`) REFERENCES `cryptocurrencies` (`CryptocurrencyID`);

--
-- Constraints for table `usersettings`
--
ALTER TABLE `usersettings`
  ADD CONSTRAINT `usersettings_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `wallets_ibfk_2` FOREIGN KEY (`CryptocurrencyID`) REFERENCES `cryptocurrencies` (`CryptocurrencyID`);

--
-- Constraints for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD CONSTRAINT `withdrawals_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

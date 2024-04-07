SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE DATABASE IF NOT EXISTS `lb_pdo_workers` DEFAULT CHARACTER SET cp1251 COLLATE cp1251_general_ci;
USE `lb_pdo_workers`;


CREATE TABLE `department` (
  `ID_DEPARTMENT` int(11) NOT NULL,
  `chief` char(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;


INSERT INTO `department` (`ID_DEPARTMENT`, `chief`) VALUES
(0, 'Jobs'),
(1, 'Wozniak'),
(2, 'Gates');


CREATE TABLE `project` (
  `ID_PROJECTS` int(11) NOT NULL,
  `name` char(60) DEFAULT NULL,
  `manager` char(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;


INSERT INTO `project` (`ID_PROJECTS`, `name`, `manager`) VALUES
(0, 'Project_1, Hospital', 'Ivanov'),
(1, 'Project_2, Bank', 'Petrov'),
(2, 'Project_3, Police', 'Sidorov');


CREATE TABLE `work` (
  `FID_WORKER` int(11) DEFAULT NULL,
  `FID_PROJECTS` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `time_start` date DEFAULT NULL,
  `time_end` date DEFAULT NULL,
  `description` char(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;


INSERT INTO `work` (`FID_WORKER`, `FID_PROJECTS`, `date`, `time_start`, `time_end`, `description`) VALUES
(1, 2, '2019-04-10', '2019-04-10', '2019-04-14', 'some work for 16-5'),
(3, 1, '2019-04-15', '2019-04-15', '2019-04-17', 'bank'),
(4, 1, '2019-04-16', '2019-04-15', '2019-04-17', 'new bank'),
(2, 0, '2019-04-22', '2019-04-22', '2019-04-30', 'hospital');


CREATE TABLE `worker` (
  `ID_WORKER` int(11) NOT NULL,
  `FID_DEPARTMENT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;


INSERT INTO `worker` (`ID_WORKER`, `FID_DEPARTMENT`) VALUES
(2, 0),
(1, 2),
(3, 2),
(4, 2);


ALTER TABLE `department`
  ADD PRIMARY KEY (`ID_DEPARTMENT`);


ALTER TABLE `project`
  ADD PRIMARY KEY (`ID_PROJECTS`);


ALTER TABLE `work`
  ADD PRIMARY KEY (`date`),
  ADD KEY `FID_WORKER` (`FID_WORKER`),
  ADD KEY `FID_PROJECTS` (`FID_PROJECTS`);


ALTER TABLE `worker`
  ADD PRIMARY KEY (`ID_WORKER`),
  ADD KEY `FID_DEPARTMENT` (`FID_DEPARTMENT`);


ALTER TABLE `worker`
  MODIFY `ID_WORKER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `work`
  ADD CONSTRAINT `work_ibfk_1` FOREIGN KEY (`FID_WORKER`) REFERENCES `worker` (`ID_WORKER`),
  ADD CONSTRAINT `work_ibfk_2` FOREIGN KEY (`FID_PROJECTS`) REFERENCES `project` (`ID_PROJECTS`);


ALTER TABLE `worker`
  ADD CONSTRAINT `worker_ibfk_1` FOREIGN KEY (`FID_DEPARTMENT`) REFERENCES `department` (`ID_DEPARTMENT`);
COMMIT;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



CREATE TABLE `event` (
  `idEvent` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `departement` varchar(100) NOT NULL,
  `lieu` varchar(1024) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;
INSERT INTO `event` (`idEvent`, `nom`, `departement`, `lieu`, `date`) VALUES
(1, 'Aucun', 'Aucun', 'Aucun', '0001-01-01 00:00:00'),
(2, 'Test10', 'Test10', 'Test10', '2023-12-16 00:00:00'),
(3, 'Test11', 'Test11', 'Test11', '2023-09-27 00:00:00'),
(4, 'Test12', 'Test12', 'Test12', '2023-09-20 00:00:00'),
(5, 'Test13', 'Test13', 'Test13', '2023-08-30 00:00:00'),
(6, 'Test14', 'Test14', 'Test14', '2023-09-19 00:00:00'),
(7, 'Test15', 'Test15', 'Test15', '2023-09-20 00:00:00'),
(8, 'Test16', 'Test16', 'Test16', '2023-09-20 00:00:00');

CREATE TABLE `satisfaction` (
  `idSatisfaction` int(11) PRIMARY KEY AUTO_INCREMENT,
  `highEtu` int(11) NOT NULL,
  `midEtu` int(11) NOT NULL,
  `lowEtu` int(11) NOT NULL,
  `highEmplo` int(11) NOT NULL,
  `midEmplo` int(11) NOT NULL,
  `lowEmplo` int(11) NOT NULL,
  FOREIGN KEY (idSatisfaction) REFERENCES event(idEvent)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;
INSERT INTO `satisfaction` (`idSatisfaction`, `highEtu`, `midEtu`, `lowEtu`, `highEmplo`, `midEmplo`, `lowEmplo`) VALUES
(1, 99, 99, 99, 99, 99, 99),
(2, 0, 0, 0, 0, 0, 0),
(3, 0, 0, 0, 0, 0, 0),
(4, 0, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 0, 0),
(6, 0, 0, 0, 0, 0, 0),
(7, 0, 0, 0, 0, 0, 0),
(8, 0, 0, 0, 0, 0, 0);
-- TABLE USER
CREATE TABLE `user` (
  `numEmploye` int(11) PRIMARY KEY NOT NULL,
  `password` varchar(1024) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `recoverEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;
INSERT INTO `user` (`numEmploye`, `password`, `prenom`, `nom`, `recoverEmail`) VALUES
(1, '356a192b7913b04c54574d18c28d46e6395428ab', 'Test', 'Test', 'test@testemail.com'),
(1865294, 'c23d9df5e16d53fd23a0c6fd694b350aac09f8cf', 'Gabryel', 'Poisson', 'gabryel.poisson.01@edu.cegeptr.qc.ca'),
(2232140, 'qwerty1234', 'Marius', 'Testard', 'marius.testard.01@edu.cegeptr.qc.ca');

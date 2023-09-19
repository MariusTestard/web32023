
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- TABLE SATISFACTION
CREATE TABLE `event` (
  `idEvent` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `departement` varchar(100) NOT NULL,
  `lieu` varchar(1024) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;


-- TABLE SATISFACTION
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

-- TABLE USER
CREATE TABLE `user` (
  `numEmploye` int(11) PRIMARY KEY NOT NULL,
  `password` varchar(1024) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `recoverEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;
INSERT INTO `user` (`numEmploye`, `password`, `prenom`, `nom`, `recoverEmail`) VALUES
(1111, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'James', 'Turner', 'myriadah267@gmail.com'),
(2232140, 'qwerty1234', 'Marius', 'Testard', 'marius.testard.01@edu.cegeptr.qc.ca'),
(2232141, 'c6c4940b323ff81c66e02a02e0281c370c535008', 'Gabriel', 'Poisson', 'tehtar4857@gmail.com');

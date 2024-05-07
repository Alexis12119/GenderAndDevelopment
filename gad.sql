-- Create the database 'gad' if it doesn't exist
CREATE DATABASE IF NOT EXISTS gad;

-- Switch to the 'gad' database
USE gad;

-- Create table 'ra7877' with a timestamp column for record creation time
CREATE TABLE IF NOT EXISTS `ra7877` (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    totalScore INT NOT NULL,
    createdTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Time when the record is created'
);

-- Create table 'ra9262' with a timestamp column for record creation time
CREATE TABLE IF NOT EXISTS `ra9262` (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    totalScore INT NOT NULL,
    createdTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Time when the record is created'
);

-- Create table 'ra9710' with a timestamp column for record creation time
CREATE TABLE IF NOT EXISTS `ra9710` (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    totalScore INT NOT NULL,
    createdTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Time when the record is created'
);

-- Create table 'ra11313' with a timestamp column for record creation time
CREATE TABLE IF NOT EXISTS `ra11313` (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    totalScore INT NOT NULL,
    createdTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Time when the record is created'
);

CREATE TABLE gender (
    genderID INT AUTO_INCREMENT PRIMARY KEY,
    genderName VARCHAR(255) NOT NULL
);

INSERT INTO gender (genderName) VALUES ('Man'), ('Woman'), ('Transgender'),('Asexual');

CREATE TABLE department (
    departmentCode VARCHAR(255) PRIMARY KEY,
    departmentName VARCHAR(255) NOT NULL
);

INSERT INTO department (departmentCode, departmentName) VALUES 
('ccst', 'College Of Computer Studies and Technology'),
('coa', 'College of Accountacy'),
('coe', 'College of Engineering'),
('cthm', 'College of Hotel Management');

CREATE TABLE users (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(255) NOT NULL,
    middleName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    genderID INT NOT NULL,
    departmentCode VARCHAR(255) NOT NULL,
    FOREIGN KEY (genderID) REFERENCES gender(genderID),
    FOREIGN KEY (departmentCode) REFERENCES department(departmentCode)
);

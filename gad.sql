-- Create the database 'gad' if it doesn't exist
CREATE DATABASE IF NOT EXISTS gad;

-- Switch to the 'gad' database
USE gad;

-- Create table 'ra7877' with a timestamp column for record creation time
CREATE TABLE IF NOT EXISTS `ra7877` (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    totalScore INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Time when the record is created'
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

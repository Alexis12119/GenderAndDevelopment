-- Create the database 'gad'
CREATE DATABASE IF NOT EXISTS gad;

-- Switch to the 'gad' database
USE gad;

-- Create the 'lawone' table
CREATE TABLE IF NOT EXISTS `lawone` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    totalScore INT NOT NULL
);

-- Create the 'lawtwo' table
CREATE TABLE IF NOT EXISTS `lawtwo` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    totalScore INT NOT NULL
);

-- Create the 'lawthree' table
CREATE TABLE IF NOT EXISTS `lawthree` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    totalScore INT NOT NULL
);

-- Create the 'lawfour' table
CREATE TABLE IF NOT EXISTS `lawfour` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    totalScore INT NOT NULL
);

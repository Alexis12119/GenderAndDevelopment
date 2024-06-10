-- Create the database 'gad' if it doesn't exist
CREATE DATABASE IF NOT EXISTS gad;

-- Switch to the 'gad' database
USE gad;

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (username, password) VALUES ('admin', 'admin123');

-- Creating table to store law names and their codes
CREATE TABLE IF NOT EXISTS `lawname` (
    lawCode INT NOT NULL PRIMARY KEY,
    lawName VARCHAR(255) NOT NULL
);

-- Creating table to store law-related records
CREATE TABLE IF NOT EXISTS `law` (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    totalScore INT NOT NULL,
    lawCode INT NOT NULL,
    FOREIGN KEY (lawCode) REFERENCES lawname(lawCode)
);

-- Inserting law names into the 'lawname' table
INSERT INTO `lawname` (lawCode, lawName) VALUES
    (7877,'Anti-Sexual Harassment Act of 1995'), -- RA 7877
    (9262,'Anti-Violence Against Women and their Children'), -- RA 9262
    (9710,'Magna Carta for Women'), -- RA 9710
    (11313,'Safe Spaces Act'); -- RA 11313

-- Inserting records into the 'law' table
INSERT INTO `law` (email, totalScore, lawCode) VALUES
    ('example1@example.com', 25, 7877), -- For Anti-Sexual Harassment Act of 1995 (RA 7877)
    ('example2@example.com', 20, 9262), -- For Anti-Violence Against Women and their Children (RA 9262)
    ('example3@example.com', 10, 9710), -- For Magna Carta for Women (RA 9710)
    ('example4@example.com', 15, 11313); -- For Safe Spaces Act (RA 11313)

-- Creating table to store gender information
CREATE TABLE gender (
    genderID INT AUTO_INCREMENT PRIMARY KEY,
    genderName VARCHAR(255) NOT NULL
);

-- Inserting gender information
INSERT INTO gender (genderName) VALUES ('Man'), ('Woman'), ('Transgender'),('Asexual'), ('Gay'), ('Lesbian'), ('Bisexual'), ('Queer/Questioning');

-- Creating table to store department information
CREATE TABLE department (
    departmentCode VARCHAR(255) PRIMARY KEY,
    departmentName VARCHAR(255) NOT NULL
);

-- Inserting department information
INSERT INTO department (departmentCode, departmentName) VALUES 
('ccst', 'College Of Computer Studies and Technology'),
('coa', 'College of Accountacy'),
('cas', 'College of Arts And Science'),
('cba', 'College of Business Administration'),
('coe', 'College of Engineering'),
('cte', 'College of Teacher Education'),
('chs', 'College of Allied Health Sciences'),
('cthm', 'College of Tourism And Hospitality Management');

-- Creating table to store profiles with gender and department associations
CREATE TABLE profiles (
    profileID INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(255) NOT NULL,
    middleName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    genderID INT NOT NULL,
    departmentCode VARCHAR(255) NOT NULL,
    FOREIGN KEY (genderID) REFERENCES gender(genderID),
    FOREIGN KEY (departmentCode) REFERENCES department(departmentCode)
);

INSERT INTO profiles (firstName, middleName, lastName, genderID, departmentCode) VALUES
    ('John', 'William', 'Smith', 1, 'ccst'), -- Man, College Of Computer Studies and Technology
    ('Jane', 'Elizabeth', 'Doe', 2, 'coa'), -- Woman, College of Accountancy
    ('Michael', 'James', 'Johnson', 1, 'cas'), -- Man, College of Arts And Science
    ('Emily', 'Grace', 'Brown', 2, 'cba'), -- Woman, College of Business Administration
    ('David', 'Alexander', 'Miller', 5, 'coe'), -- Gay, College of Engineering
    ('Sarah', 'Michelle', 'Wilson', 6, 'cte'), -- Lesbian, College of Teacher Education
    ('Daniel', 'Robert', 'Taylor', 1, 'chs'), -- Man, College of Allied Health Sciences
    ('Jessica', 'Marie', 'Anderson', 2, 'cthm'), -- Woman, College of Tourism And Hospitality Management
    ('Christopher', 'John', 'Lee', 4, 'ccst'), -- Asexual, College Of Computer Studies and Technology
    ('Amanda', 'Nicole', 'Harris', 7, 'coa'), -- Bisexual, College of Accountancy
    ('Matthew', 'Thomas', 'Clark', 1, 'cas'), -- Man, College of Arts And Science
    ('Lauren', 'Ashley', 'Martinez', 2, 'cba'), -- Woman, College of Business Administration
    ('Andrew', 'Jacob', 'White', 5, 'coe'), -- Gay, College of Engineering
    ('Olivia', 'Sophia', 'King', 6, 'cte'), -- Lesbian, College of Teacher Education
    ('William', 'Ryan', 'Green', 1, 'chs'), -- Man, College of Allied Health Sciences
    ('Samantha', 'Elizabeth', 'Thompson', 2, 'cthm'), -- Woman, College of Tourism And Hospitality Management
    ('Ryan', 'Patrick', 'Young', 3, 'ccst'), -- Transgender, College Of Computer Studies and Technology
    ('Hannah', 'Victoria', 'Scott', 8, 'coa'), -- Queer/Questioning, College of Accountancy
    ('Jacob', 'Benjamin', 'Evans', 1, 'cas'), -- Man, College of Arts And Science
    ('Megan', 'Rachel', 'Turner', 2, 'cba'), -- Woman, College of Business Administration
    ('Nathan', 'Daniel', 'Hill', 5, 'coe'), -- Gay, College of Engineering
    ('Alyssa', 'Christina', 'Wright', 6, 'cte'), -- Lesbian, College of Teacher Education
    ('James', 'Brandon', 'Adams', 1, 'chs'), -- Man, College of Allied Health Sciences
    ('Taylor', 'Rebecca', 'Perez', 2, 'cthm'); -- Woman, College of Tourism And Hospitality Management

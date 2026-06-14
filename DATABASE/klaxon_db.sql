-- - - - - - - - - - - - - - - - - - - - 
-- Create the database KLAXON  - - - - - 
-- - - - - - - - - - - - - - - - - - - - 

-- DROP DATABASE if existe
DROP DATABASE IF EXISTS klaxon;

-- Create database
CREATE DATABASE IF NOT EXISTS klaxon DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Select database
USE klaxon;



-- - - - - - - - - - - - - - - - - - - - 
-- Create Tables 
-- - - - - - - - - - - - - - - - - - - - 

-- - - - - - - - - - - - - - - - - - - - 
-- TABLE AGENCIES
-- - - - - - - - - - - - - - - - - - - - 
DROP TABLE IF EXISTS agencies;
CREATE TABLE agencies (
    id INT AUTO_INCREMENT,
    city VARCHAR(100) NOT NULL UNIQUE,
    PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- - - - - - - - - - - - - - - - - - - - 
-- TABLE ENPLOYEES
-- - - - - - - - - - - - - - - - - - - - 
DROP TABLE IF EXISTS employees;
CREATE TABLE employees (
    id INT AUTO_INCREMENT,
    lastname VARCHAR(100),
    firstname VARCHAR(100),
    phone VARCHAR(20) UNIQUE,
    email VARCHAR(255) UNIQUE,
    passeword VARCHAR(255),
    role ENUM('USER', 'ADMIN') DEFAULT 'USER',
    PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- - - - - - - - - - - - - - - - - - - - 
-- TABLE TRAVELS
-- - - - - - - - - - - - - - - - - - - - 
DROP TABLE IF EXISTS travels;
CREATE TABLE travels (
    id INT AUTO_INCREMENT,

    departure_agency_id INT NOT NULL,
    arrival_agency_id INT NOT NULL,

    departure_at DATETIME NOT NULL,
    arrival_at DATETIME NOT NULL,

    seats_total INT NOT NULL,
    seats_available INT DEFAULT 0,

    employee_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY(departure_agency_id) REFERENCES agencies(id),
    FOREIGN KEY(arrival_agency_id) REFERENCES agencies(id),
    FOREIGN KEY(employee_id) REFERENCES employees(id),

    CONSTRAINT chk_seats_Max CHECK ((seats_total > 0)),
    CONSTRAINT chk_seats_available CHECK ((seats_available BETWEEN 0 AND seats_total)),

    CONSTRAINT chk_agencie_not_same CHECK ((departure_agency_id <> arrival_agency_id)),
    CONSTRAINT chk_dateTime CHECK ((departure_at < arrival_at))
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- - - - - - - - - - - - - - - - - - - - 
-- Create users with privileges
-- - - - - - - - - - - - - - - - - - - - 

-- Creation Role
CREATE ROLE 'admin_role';
CREATE ROLE 'users_role';

-- Privileges of roles
GRANT ALL PRIVILEGES ON klaxon.* TO 'admin_role';

GRANT SELECT ON klaxon.employees TO 'users_role';
GRANT SELECT ON klaxon.agencies TO 'users_role';
GRANT SELECT, INSERT, UPDATE, DELETE ON klaxon.travels TO 'users_role';

-- Create user ADMIN
DROP USER IF EXISTS 'klaxon_admin'@'localhost';
CREATE USER 'klaxon_admin'@'localhost' IDENTIFIED BY 'admin3322';

-- Create user USERS
DROP USER  IF EXISTS 'klaxon_users'@'localhost';
CREATE USER 'klaxon_users'@'localhost' IDENTIFIED BY 'users3322';

-- Attribute grants
GRANT 'admin_role' TO 'klaxon_admin'@'localhost';
GRANT 'users_role' TO 'klaxon_users'@'localhost';

-- Apply privileges
FLUSH PRIVILEGES;

SET DEFAULT ROLE 'admin_role' TO 'klaxon_admin'@'localhost';
SET DEFAULT ROLE 'users_role' TO 'klaxon_users'@'localhost';

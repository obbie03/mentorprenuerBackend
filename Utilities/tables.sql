
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId int not null,
    firstName VARCHAR(50) NOT NULL,
    otherName VARCHAR(50),
    lastName VARCHAR(50) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,
    dob DATE,
    level VARCHAR(100) NOT NULL,
    field VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS authentication (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cid int not null,
    email VARCHAR(50) NOT NULL,
    password varchar(255) NOT NULL,
    userType int not null DEFAULT 0,
    date   TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);


CREATE TABLE IF NOT EXISTS cohorts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cid int not null,
    name varchar(100) NOT NULL,
    description varchar(100) NOT NULL,
    addedBy int not null DEFAULT 0,
    date   TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);


CREATE TABLE IF NOT EXISTS languages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name varchar(100) NOT NULL,
    addedBy int not null DEFAULT 0,
    date   TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE IF NOT EXISTS locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name varchar(100) NOT NULL,
    addedBy int not null DEFAULT 0,
    date   TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cid int not null,
    name varchar(100) NOT NULL,
    type varchar(100) NOT NULL,
    addedBy int not null DEFAULT 0,
    date   TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);





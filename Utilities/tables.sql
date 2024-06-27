
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
    email VARCHAR(50) NOT NULL,
    password varchar(255) NOT NULL,
    userType int not null DEFAULT 0,
    date   TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);





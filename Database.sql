--USERS TABLE
CREATE TABLE users
(
    id              INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name      VARCHAR(255) NOT NULL,
    last_name       VARCHAR(255) NOT NULL,
    email           VARCHAR(255) NOT NULL UNIQUE,
    role            VARCHAR(255) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL,
    account_status  BOOLEAN DEFAULT TRUE
)
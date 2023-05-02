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

--PREPACKAGED EVENT TABLE
CREATE TABLE prepackaged_events
(
    id           INT(11) AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(255) NOT NULL UNIQUE,
    location     VARCHAR(255) NOT NULL,
    price        INT(11) NOT NULL,
    description  TEXT         NOT NULL,
    thumbnail    TEXT         NOT NULL,
    event_date   DATE         NOT NULL,
    event_status BOOLEAN DEFAULT TRUE
)

CREATE TABLE customer_enquiry
(
    id        INT(11) AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email     VARCHAR(255) NOT NULL,
    message   TEXT         NOT NULL
)


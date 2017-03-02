DROP TABLE IF EXISTS userTypes;
DROP TABLE IF EXISTS users;

CREATE TABLE userTypes (
    userTypeId INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    userTypeName VARCHAR(100) NOT NULL,
    canModifyUsers SMALLINT(1) NOT NULL,
    canScan SMALLINT(1) NOT NULL,
    canPrint SMALLINT(1) NOT NULL
);

CREATE TABLE users(
    userId INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    userTypeId INT(50) NOT NULL DEFAULT 1,
    facebookId INT(50) NOT NULL,
    name VARCHAR(100) NOT NULL
);

/** Important that the newUser is userType 1 **/
INSERT INTO userTypes VALUES (1, 'newUser', 0, 0, 0);

INSERT INTO userTypes (userTypeName, canModifyUsers, canScan, canPrint) VALUES
    ('printUser', 0, 0, 1),
    ('scanAndPrint', 0, 1, 1),
    ('admin', 1, 1, 1),
    ('nonUserAdmin', 1, 0, 0)
    ;

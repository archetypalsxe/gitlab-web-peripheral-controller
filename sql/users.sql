DROP TABLE IF EXISTS users;

CREATE TABLE users(
    mac char(12),
    enabled smallint(1)
);

INSERT INTO users VALUES (
    'Testing this',
    1
);

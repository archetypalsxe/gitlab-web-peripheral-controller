<?php

namespace Database;

use \Database\Connection as DatabaseConnection;

/**
 * Database controller for the table for users
 */
class User extends DatabaseConnection
{
    /**
     * Query the database for a provided user and return the results
     *
     * @param int $userId
     * @return string[] @TODO Return a user model
     */
    public function getUserData($userId)
    {
        $userId = (int)$userId;
        $result = $this->query(
            "SELECT * FROM Users WHERE userId = :userId LIMIT 1",
            [':userId' => $userId]
        );
        return $this->fetchResults($result);
    }

    /**
     * Save a new user in the database
     *
     * @param int $userId
     * @param string $name
     * @return bool Whether or not it was successful
     */
    public function saveNewUser($userId, $name)
    {
        $result = $this->query(
            "INSERT INTO Users(facebookId, name) VALUES (:userId, :name)",
            [':userId' => (int)$userId, ':name' => (string)$name]
        );
        var_dump(self::$connection->errorInfo());
        return $result;
    }
}

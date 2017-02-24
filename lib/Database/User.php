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
            "SELECT * FROM Users WHERE userId = {$userId} LIMIT 1"
        );
        var_dump($result);
    }
}

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
     * @param int $facebookId
     * @return string[] @TODO Return a user model
     */
    public function getUserData($facebookId)
    {
        $result = $this->query(
            "SELECT * FROM users WHERE facebookId = :facebookId LIMIT 1",
            [':facebookId' => (int)$facebookId]
        );
        if($result) {
            return $this->fetchResults($result);
        }
    }

    /**
     * Save a new user in the database
     *
     * @param int $facebookId
     * @param string $name
     * @return bool Whether or not it was successful
     */
    public function saveNewUser($facebookId, $name)
    {
        $result = $this->query(
            "INSERT INTO users(facebookId, name) VALUES (:userId, :name)",
            [':userId' => (int)$facebookId, ':name' => (string)$name]
        );
        return $result;
    }
}

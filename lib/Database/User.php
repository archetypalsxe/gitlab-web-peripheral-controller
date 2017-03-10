<?php

namespace Database;

use \Database\Connection as DatabaseConnection;
use \Exception;

/**
 * Database controller for the table for users
 */
class User extends DatabaseConnection
{
    const CAN_MODIFY_USERS = "canModifiyUsers";
    const CAN_SCAN = "canScan";
    const CAN_PRINT = "canPrint";


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
            "INSERT INTO users(facebookId, name) VALUES (:facebookId, :name)",
            [':facebookId' => (int)$facebookId, ':name' => (string)$name]
        );
        return $result;
    }

    /**
     * Get which actions the user is allowed to perform
     *
     * @param string $userId
     * @return string[]
     */
    public function getUserPermissions($userId)
    {
        if(empty($userId)) {
            throw new Exception("Invalid user ID provided");
        }
        $result = $this->query(
            "SELECT canModifyUsers, canScan, canPrint
            FROM users INNER JOIN userTypes USING (userTypeId)
            WHERE userId = :userId LIMIT 1",
            ['userId' => $userId]
        );
        if($result) {
            $rawData = $this->fetchResults($result);
            // We should only have 1 because of the limit
            return array_pop($rawData);
        }
        return [];
    }
}

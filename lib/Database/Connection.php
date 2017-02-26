<?php

namespace Database;

use \Database\HelperInterface as DatabaseHelperInterface;
use \Database\HelperTrait as DatabaseHelperTrait;
use \PDO;
use \PDOStatement;

/**
 * Class for maintaining the connection to the database
 */
abstract class Connection implements DatabaseHelperInterface
{

    use DatabaseHelperTrait;

    /**
     * The actual connection to the database
     *
     * @var PDO
     */
    protected static $connection;

    /**
     * Queries the database based on the provided query string
     *
     * @param string $query
     * @return PDOStatement
     */
    protected function query($query)
    {
        $this->establishConnection();
        return self::$connection->query($query);
    }

    /**
     * Check to see if we are connected to the database, and connect if
     * we are not
     *
     * @throws PDOException
     */
    protected function establishConnection()
    {
        if(!(self::$connection instanceof PDO)) {
            self::$connection = new PDO(
                'sqlite:'. BASE_DIR . DATABASE_LOCATION
            );
        }
    }
}
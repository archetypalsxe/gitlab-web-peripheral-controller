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
     * @param string[] $parameters
     * @return PDOStatement
     */
    protected function query($query, $parameters)
    {
        $this->establishConnection();
        $statement = self::$connection->prepare($query);
        if($statement) {
            return $statement->execute($parameters);
        }
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
                //'sqlite:'. BASE_DIR . DATABASE_LOCATION
                'sqlite:/tmp/default.db'
            );
            if (SHOW_DEBUG) {
                self::$connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
            }
        }
    }
}

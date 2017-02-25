<?php

namespace Database;

use \PDOStatement;

/**
 * Traits for assisting with dealing with the database
 */
trait HelperTrait
{

    /**
     * Parse through the results of a PDOStatement and return the results as
     * an array
     *
     * @param PDOStatement $statement
     * @return string[]
     */
    public function fetchResults(PDOStatement $statement)
    {
        return $statement->fetchAll();
    }
}

<?php

namespace Database;

use \PDOStatement;

/**
 * Interface to be used with the database helper trait
 */
interface HelperInterface
{
    /**
     * Parse through the results of a PDOStatement and return the results as
     * an array
     *
     * @param PDOStatement $statement
     * @return string[]
     */
    public function fetchResults(PDOStatement $statement);
}

<?php

/**
 * @return mysqli
 */
function db_connect(): mysqli
{
    $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connect($connection);
    return $connection;
}

/**
 * @param $connection
 * @return void
 */
function confirm_db_connect($connection): void
{
    if ($connection->connect_errno) {
        $msg = "Database connection failed: ";
        $msg .= $connection->connect_error;
        $msg .= " (" . $connection->connect_errno . ")";
        exit($msg);
    }
}

/**
 * @param $connection
 * @return void
 */
function db_disconnect($connection): void
{
    $connection->close();
}

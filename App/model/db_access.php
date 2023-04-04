<?php

/**
 * Database access class
 * 
 * @package default
 * @author Elsa Thiévet
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */
class DataAccess
{

    private static $server = 'mysql:host=localhost';
    private static $db = 'dbname=lafleur';
    private static $user = 'root';
    private static $pwd = '';

    /**
     *
     * @var PDO
     */
    private static $myPDO;

    /**
     * returns instance of PDO
     * @return PDO
     */
    public static function getPdo()
    {
        if (DataAccess::$myPDO == null) {
            DataAccess::$myPDO = new PDO(
            DataAccess::$server . ';' .
            DataAccess::$db,
            DataAccess::$user,
            DataAccess::$pwd
            );
            DataAccess::$myPDO->query("SET CHARACTER SET utf8");
        }
        return DataAccess::$myPDO;
    }

    /**
     * read request
     * @param string $sql_request
     * @return PDOStatement
     */
    public static function query(string $sql_request)
    {
        return DataAccess::getPdo()->query($sql_request);
    }

    /**
     * write request
     * @param string $sql_request
     * @return int
     */
    public static function exec(string $sql_request)
    {
        return DataAccess::getPdo()->exec($sql_request);
    }
}

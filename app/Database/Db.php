<?php

namespace App\Database;

use PDO;
use PDOException;


/**
 * Class Db
 * @package App\Database
 */
class Db
{
    /**
     * Hostname
     *
     * @var string
     */
    protected static string $host = "localhost";

    /**
     * Database name
     *
     * @var string
     */
    protected static string $dbname = "quantox";

    /**
     * User
     *
     * @var string
     */
    protected static string $user = "root";

    /**
     * Password
     *
     * @var string
     */
    protected static string $pass = "root";

    /**
     * Private static method for creating connection to db.
     *
     * @return PDO
     */
    protected static function con() : PDO
    {
        try {
            $pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8", self::$user,
                self::$pass);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        }
        catch(PDOException $exception) {
            die('Error while trying to connect to db, please contact your admin.');
        }
    }

    /**
     * Static method for prepare, execute and fetch query statement.
     *
     * @param string $query
     * @param array $params
     * @return array
     */
    public static function getData(string $query, array $params = []) : array
    {
        $stmt = self::con()->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

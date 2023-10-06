<?php

namespace Art\Core;

class DB
{
    private static $DB = null;

    public static function getConnection()
    {
        $host = "localhost";
        $dbname = "market";
        $charset = "utf8mb4";
        $user = "root";
        $pass = "";

        if (is_null(self::$DB))
        {
            $option = [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ];

            self::$DB = new \PDO(
                "mysql:host={$host};dbname={$dbname};charset={$charset};",
                $user, $pass, $option
            );
        }

        return self::$DB;
    }

    public static function execute($sql, $data = [])
    {
        $q = self::getConnection()->prepare($sql);
        return $q->execute($data);
    }

    public static function fetch($sql, $data = [])
    {
        $q = self::getConnection()->prepare($sql);
        $q->execute($data);
        return $q->fetch();
    }

    public static function fetchAll($sql, $data = [])
    {
        $q = self::getConnection()->prepare($sql);
        $q->execute($data);
        return $q->fetchAll();
    }

    public static function lastId()
    {
        return self::getConnection()->lastInsertId();
    }
}
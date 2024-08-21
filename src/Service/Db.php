<?php

namespace src\Service;

use PDO;
use PDOException;

class Db
{
    private static PDO $pdo;

    private static array $setting = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
      PDO::ATTR_EMULATE_PREPARES => false
    ];

    public static function connect(string $host, string $user, string $pass, string $db): void
    {
        try {
            if (!isset(self::$pdo)) {
                self::$pdo = new PDO(
                    "mysql:host=$host;dbname=$db",
                    $user,
                    $pass,
                    self::$setting
                );
            }
        } catch (PDOException $e) {
            echo sprintf('Connection failed: %s', $e->getMessage());
        }

    }

    public static function setQuery(string $query, array $parameters = []): array|bool
    {
        $statement = self::$pdo->prepare($query);
        $statement->execute($parameters);

        return $statement->fetch();
    }
    public static function getQueries(string $query, array $parameters = []): array|bool
    {
        $statement = self::$pdo->prepare($query);
        $statement->execute($parameters);

        return $statement->fetchAll();
    }

}
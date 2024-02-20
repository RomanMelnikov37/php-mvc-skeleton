<?php

namespace App\Core;

class Database
{
    private static Database $instance;
    private \PDO            $connection;

    private function __construct()
    {
        $config = include ROOT . '/config/db.php';

        try {
            $options = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            $this->connection = new \PDO(
                "mysql:host={$config['host']};dbname={$config['db']}",
                $config['login'],
                $config['password'],
                $options
            );
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception("Database connection error: " . $e->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }
}
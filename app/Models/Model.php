<?php

namespace App\Models;

use App\Core\Database;

class Model
{
    protected \PDO $db;
    protected string $table = '';

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all(): bool|array
    {
        $sql = "SELECT * FROM {$this->table}";
        $STH = $this->db->query($sql);

        return $STH->fetchAll(\PDO::FETCH_OBJ);
    }

    public function find(int $id): bool|object
    {
        $sql = "SELECT * FROM {$this->table} WHERE id=?";
        $STH = $this->db->prepare($sql);
        $STH->execute([$id]);

        return $STH->fetch(\PDO::FETCH_OBJ);
    }
}
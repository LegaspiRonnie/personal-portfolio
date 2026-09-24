<?php


declare(strict_types=1);
header("Content-Type: application/json; charset=utf-8");

class Item
{
    public int $id;

    private PDO $conn;

    private string $table = "rest_items";

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function search(string $q): array
    {
        $escapedQuery = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $q);

        $query = "SELECT *
                  FROM {$this->table}
                  WHERE name LIKE :search ESCAPE '\\\\' 
                  LIMIT 10";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ':search' => "%{$escapedQuery}%",
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

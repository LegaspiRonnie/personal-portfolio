<?php
declare(strict_types=1);

class Project
{
    private const int LIST_LIMIT = 10;

    private PDO $conn;
    private string $table = '_projects';

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function index(?int $id = null): array
    {
        if ($id === null) {
            $stmt = $this->conn->query(
                "SELECT * FROM {$this->table} LIMIT " . self::LIST_LIMIT
            );
            
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $projects === false ? [] : $projects;
        }

        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1"
        );
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        return $project === false ? [] : $project;
    }
}
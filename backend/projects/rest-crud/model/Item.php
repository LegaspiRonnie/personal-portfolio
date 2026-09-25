<?php


declare(strict_types=1);
class Item
{
    private const TABLE = 'rest_items';
    private const SORT_COLUMNS = ['name', 'price', 'rarity'];
    private const SORT_DIRECTIONS = ['asc', 'desc'];

    public function __construct(private PDO $conn) {}

    public function search(string $q): array
    {
        $q = trim($q);
        if ($q === '' || strlen($q) > 400) {
            throw new InvalidArgumentException('Search query must contain 1 to 400 bytes.');
        }

        // Treat SQL LIKE wildcards as ordinary characters supplied by the user.
        $escapedQuery = str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $q);

        $query = "SELECT *
                  FROM " . self::TABLE . "
                  WHERE name LIKE :search ESCAPE '!'
                  LIMIT 10";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ':search' => "%{$escapedQuery}%",
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sort(string $sort_by, string $order_by): array
    {
        $sort_by = strtolower($sort_by);
        $order_by = strtolower($order_by);

        // Identifiers and SQL keywords cannot be bound as PDO parameters.
        // Validate here too so callers cannot bypass the endpoint checks.
        if (!in_array($sort_by, self::SORT_COLUMNS, true)) {
            throw new InvalidArgumentException('Invalid sort column.');
        }
        if (!in_array($order_by, self::SORT_DIRECTIONS, true)) {
            throw new InvalidArgumentException('Invalid sort direction.');
        }

        $query = "SELECT * FROM " . self::TABLE . " ORDER BY {$sort_by} {$order_by}";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

<?php

declare(strict_types=1);
class Item
{
    private const TABLE = 'rest_items';
    private const SORT_COLUMNS = ['name', 'price', 'rarity'];
    private const SORT_DIRECTIONS = ['asc', 'desc'];
    private const FILTER_COLUMNS = ['category', 'rarity'];

    public function __construct(private PDO $conn) {}



    public function index(int $offset, int $limit, ?string $order_by = 'id'): array
    {
        // This argument becomes part of SQL, so accept only a known column name.
        if ($order_by !== 'id') {
            throw new InvalidArgumentException('Invalid order column.');
        }

        $countStmt = $this->conn->query('SELECT COUNT(*) FROM ' . self::TABLE);
        $total = (int) $countStmt->fetchColumn();

        $query = "SELECT * 
                  FROM " . self::TABLE . "
                  ORDER BY {$order_by}
                  LIMIT :limit
                  OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':limit'    => $limit,
            ':offset'   => $offset,
        ]);

        return [
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'total' => $total,
        ];
    }

    public static function validateCreateData(array $data): array
    {
        $name = $data['name'] ?? null;
        $category = $data['category'] ?? null;
        $rarity = $data['rarity'] ?? null;
        $price = $data['price'] ?? null;

        if (!is_string($name) || trim($name) === '') {
            throw new InvalidArgumentException('Name is required.');
        }
        $name = trim($name);
        if (strlen($name) > 255) {
            throw new InvalidArgumentException('Name must be 255 bytes or fewer.');
        }

        $allowedCategories = ['weapon', 'armor', 'consumable', 'accessory'];
        if (!is_string($category) || !in_array(strtolower(trim($category)), $allowedCategories, true)) {
            throw new InvalidArgumentException('Select a valid category.');
        }
        $category = strtolower(trim($category));

        $allowedRarities = ['common', 'uncommon', 'rare', 'epic', 'legendary'];
        if (!is_string($rarity) || !in_array(strtolower(trim($rarity)), $allowedRarities, true)) {
            throw new InvalidArgumentException('Select a valid rarity.');
        }
        $rarity = strtolower(trim($rarity));

        if ((!is_string($price) && !is_int($price) && !is_float($price))
            || !is_numeric($price)
            || !is_finite((float) $price)
            || (float) $price < 0
            || !preg_match('/^\d+(?:\.\d{1,2})?$/D', (string) $price)) {
            throw new InvalidArgumentException('Price must be a non-negative number with at most 2 decimal places.');
        }

        return [
            'name' => $name,
            'category' => $category,
            'rarity' => $rarity,
            'price' => number_format((float) $price, 2, '.', ''),
        ];
    }

    public function create(array $data): int
    {
        // Keep model validation here too, so direct callers cannot bypass it.
        $data = self::validateCreateData($data);

        $query = "INSERT INTO " . self::TABLE .
                 " (name, category, rarity, price) " .
                 "VALUES (:name, :category, :rarity, :price)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ':name' => $data['name'],
            ':category' => $data['category'],
            ':rarity' => $data['rarity'],
            ':price' => $data['price'],
        ]);

        return (int) $this->conn->lastInsertId();
    }


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

    public function filter(array $filters): array
    {
        $conditions = [];
        $parameters = [];

        foreach (self::FILTER_COLUMNS as $column) {
            if (isset($filters[$column]) && $filters[$column] !== '') {
                $conditions[] = "{$column} = ?";
                $parameters[] = $filters[$column];
            }
        }

        if (isset($filters['min_price'])) {
            $conditions[] = 'price >= ?';
            $parameters[] = $filters['min_price'];
        }
        if (isset($filters['max_price'])) {
            $conditions[] = 'price <= ?';
            $parameters[] = $filters['max_price'];
        }
        if (isset($filters['q']) && $filters['q'] !== '') {
            $escapedQuery = str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $filters['q']);
            $conditions[] = "name LIKE ? ESCAPE '!'";
            $parameters[] = "%{$escapedQuery}%";
        }

        $where = $conditions ? ' WHERE ' . implode(' AND ', $conditions) : '';
        $sortBy = $filters['sort_by'] ?? 'name';
        $orderBy = $filters['order_by'] ?? 'asc';
        $limit = $filters['limit'] ?? 20;
        $offset = $filters['offset'] ?? 0;

        if (!in_array($sortBy, self::SORT_COLUMNS, true)) {
            throw new InvalidArgumentException('Invalid sort column.');
        }
        if (!in_array($orderBy, self::SORT_DIRECTIONS, true)) {
            throw new InvalidArgumentException('Invalid sort direction.');
        }
        // LIMIT and OFFSET are integers validated by the endpoint and interpolated here.
        $query = 'SELECT * FROM ' . self::TABLE . $where
            . " ORDER BY {$sortBy} {$orderBy} LIMIT " . (int) $limit
            . ' OFFSET ' . (int) $offset;

        $stmt = $this->conn->prepare($query);
        $stmt->execute($parameters);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

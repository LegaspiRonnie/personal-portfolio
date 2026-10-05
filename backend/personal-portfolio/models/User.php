<?php

declare(strict_types=1);

class User {
    private PDO $db;
    private const TABLE = '_users';

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findUser(string $email): bool
    {
        $query = "SELECT id
                  FROM " . self::TABLE . "
                  WHERE email = ? 
                  LIMIT 1";
        $stmt = $this->db->prepare($query);

        $stmt->execute([
            $email,
        ]);

        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    // log user in 
    public function login(string $email, string $password): array
    {   
        $query = "SELECT id, username, email, password " . 
                " FROM " . self::TABLE . 
                " WHERE email = ?" .
                " LIMIT 1";
        $stmt = $this->db->prepare($query);

        $stmt->execute([
            $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!password_verify($password, $user['password'])) {
            return [
                'code'    => 401,
                'status'  => 'error',
                'message' => 'Password incorrect',
            ];
        }

        return [
            'code' => 200,
            'status' => 'success',
            'message' => 'Login success',
            'user' => $user,
        ];
    }


}
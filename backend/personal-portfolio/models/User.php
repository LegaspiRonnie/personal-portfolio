<?php

declare(strict_types=1);

class User
{
    private PDO $conn;
    private string $table = '_users';

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function login(string $email, string $password): array
    {
        $normalizedEmail = strtolower(trim($email));

        $sql = "SELECT id, username, email, password FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $normalizedEmail, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return [
                'status' => false,
                'message' => 'No user found with that account',
            ];
        }

        // if (!password_verify($password, $user['password'])) {
        //     return [
        //         'status' => false,
        //         'message' => 'Incorrect email or password',
        //     ];
        // }

        unset($user['password']);

        return [
            'status' => true,
            'message' => 'Login successful',
            'user' => $user,
        ];
    }

    public function profile(?int $id = null)
    {
        // TODO: implement profile logic later
    }
}

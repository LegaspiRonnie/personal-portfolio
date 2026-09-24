<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

class User
{
    public int $id;
    public string $username;
    public string $email;
    public string $password;
    public PDO $conn;
    // private string $table = 'rest_crud_users';
    private string $table = '_users';

    // Constructor to initialize the database connection
    public function __construct(private PDO $db)
    {
        $this->conn = $db;
    }

    // get all users
    public function index(): array
    {
        $query = "SELECT id, username, email FROM {$this->table}";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    // get single user
    public function show(int $id): array
    {
        $query = "SELECT id, username, email FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return [];
        }


        $this->id       = (int) $result['id'];
        $this->username = (string) $result['username'];
        $this->email    = (string) $result['email'];


        return $result;
    }

    // create user
    public function create(string $username, string $email, string $password): bool
    {

        $query = "INSERT INTO {$this->table} (username, email, password)
                  VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }

    // update user
    public function update(int $id, array $data): bool
    {

        $query = "UPDATE {$this->table} 
                  SET username = :username, email = :email, password = :password 
                  WHERE id = :id LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $this->id = $id;
        $this->username = (string) $data['username'];
        $this->email = (string) $data['email'];

        if ($stmt) {
            return true;
        }
        return false;
    }

    // delete user
    public function delete(int $id): bool
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }

    // check if username exists
    public function isUsernameExist(string $username, $id = null): bool
    {
        if ($id != null) {
            $query = "SELECT id FROM {$this->table} WHERE username = :username AND id != :id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        }

        $query = "SELECT id FROM {$this->table} WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    // check if email exists
    public function isEmailExist(string $email, $id = null): bool
    {
        if ($id != null) {
            $query = "SELECT id FROM {$this->table} WHERE email = :email AND id != :id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        }

        $query = "SELECT id FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

}

<?php
class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $first_name;
    public $last_name;
    public $middle_name;
    public $email;
    public $phone_number;
    public $profile_image;
    public $created_at;

    public function __construct(mysqli $db) {
        $this->conn = $db;
    }

    public function create(): bool {
        $query = "INSERT INTO " . $this->table . " 
                  (first_name, last_name, middle_name, email, phone_number, profile_image, created_at) 
                  VALUES (?, ?, ?, ?, ?, ?, NOW())";

        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param("ssssss", 
                $this->first_name, 
                $this->last_name, 
                $this->middle_name, 
                $this->email, 
                $this->phone_number, 
                $this->profile_image
            );

            if ($stmt->execute()) {
                return true;
            }

            error_log("Failed to create user: " . $stmt->error);
        } else {
            error_log("Failed to prepare statement: " . $this->conn->error);
        }

        return false;
    }

    public function emailExists($email): bool {
        $query = "SELECT id FROM " . $this->table . " WHERE email = ? LIMIT 1";
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->num_rows > 0;
        }
        return false;
    }
}
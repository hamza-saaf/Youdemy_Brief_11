<?php
namespace App\classes;

class User {
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $role;
    private string $status;

    // Constructor
    public function __construct(int $id, string $name, string $email, string $password, string $role, string $status) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function getStatus(): string {
        return $this->status;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setRole(string $role): void {
        $this->role = $role;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    // Other Methods
    public function createUser(): bool {
        // Example: Save user to the database
        echo "User '{$this->name}' created successfully!";
        return true;
    }

    public function getUserByEmail(string $email): ?User {
        // Example: Simulate fetching user by email from a database
        if ($email === $this->email) {
            echo "User with email '{$email}' found.";
            return $this; // Returning the current user as an example
        } else {
            echo "User with email '{$email}' not found.";
            return null;
        }
    }

    public function approveTeacher(): bool {
        if ($this->role === 'teacher' && $this->status === 'pending') {
            $this->status = 'approved';
            echo "Teacher '{$this->name}' approved successfully!";
            return true;
        }
        echo "Unable to approve user '{$this->name}'.";
        return false;
    }
}

?>

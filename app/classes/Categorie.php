<?php
namespace App\classes;

class Categorie {
    private int $id;
    private string $name;

    // Constructor
    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    // Other Methods
    public function createCategorie(): bool {
        // Example: Save the category data to a database
        echo "Category '{$this->name}' created successfully!";
        return true;
    }

    public function deleteCategorie(): bool {
        // Example: Delete the category data from a database
        echo "Category with ID {$this->id} deleted successfully!";
        return true;
    }

    public function modifyCategorie(string $name): bool {
        $this->setName($name);

        // Example: Update the category data in a database
        echo "Category with ID {$this->id} modified successfully!";
        return true;
    }
}

?>

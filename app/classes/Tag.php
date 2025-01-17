<?php  
namespace App\classes;

class Tags {
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
    public function createTag(): bool {
        // Example: Save the tag data to a database
        echo "Tag '{$this->name}' created successfully!";
        return true;
    }

    public function deleteTag(): bool {
        // Example: Delete the tag data from a database
        echo "Tag with ID {$this->id} deleted successfully!";
        return true;
    }

    public function modifyTag(string $name): bool {
        $this->setName($name);

        // Example: Update the tag data in a database
        echo "Tag with ID {$this->id} modified successfully!";
        return true;
    }
}

?>
<?php
namespace App\classes;

class Cour{
    private int $id;
    private string $title;
    private string $description;
    private string $content;
    private string $wallpaper;

    // Constructor
    public function __construct(int $id, string $title, string $description, string $content, string $wallpaper)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->wallpaper = $wallpaper;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getWallpaper(): string
    {
        return $this->wallpaper;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setWallpaper(string $wallpaper): void
    {
        $this->wallpaper = $wallpaper;
    }

    // Other Methods
    public function createCours(): bool
    {
        // Example: Save the course data to a database
        echo "Course '{$this->title}' created successfully!";
        return true;
    }

    public function deleteCours(): bool
    {
        // Example: Delete the course data from a database
        echo "Course with ID {$this->id} deleted successfully!";
        return true;
    }

    public function modifyCours(string $title, string $description, string $content, string $wallpaper): bool
    {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setContent($content);
        $this->setWallpaper($wallpaper);

        // Example: Update the course data in a database
        echo "Course with ID {$this->id} modified successfully!";
        return true;
    }
}

<?php

namespace App\classes;

class Course{
    private int $id;
    private string $title;
    private string $image;
    private string $description;
    private string $content;
    private string $video;
    private string $wallpaper;

    // Constructor
    public function __construct(int $id,string $title,string $image,string $description, string $content,string $video,string $wallpaper ) {
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
        $this->description = $description;
        $this->content = $content;
        $this->video = $video;
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

    public function getImage(): string
    {
        return $this->image;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getVideo(): string
    {
        return $this->video;
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

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setVideo(string $video): void
    {
        $this->video = $video;
    }

    public function setWallpaper(string $wallpaper): void
    {
        $this->wallpaper = $wallpaper;
    }

    // Other Methods
    public function createCourse(): bool
    {
        // Example: Save the course data to a database
        echo "Course '{$this->title}' created successfully with Image '{$this->image}' and Video '{$this->video}'!";
        return true;
    }

    public function deleteCourse(): bool
    {
        // Example: Delete the course data from a database
        echo "Course with ID {$this->id} deleted successfully!";
        return true;
    }

    public function modifyCourse(
        string $title,
        string $image,
        string $description,
        string $content,
        string $video,
        string $wallpaper
    ): bool {
        $this->setTitle($title);
        $this->setImage($image);
        $this->setDescription($description);
        $this->setContent($content);
        $this->setVideo($video);
        $this->setWallpaper($wallpaper);

        // Example: Update the course data in a database
        echo "Course with ID {$this->id} modified successfully!";
        return true;
    }
    
}
<?php

class Book
{
    private int $id;
    private int $idUser;
    private string $title;
    private string $author;
    private ?string $description;
    private ?string $image;
    private bool $available;
    private string $dateCreation;

    public function __construct(array $data)
    {
        $this->id = (int) $data['id'];
        $this->idUser = (int) $data['id_user'];
        $this->title = $data['title'];
        $this->author = $data['author'];
        $this->description = $data['description'];
        $this->image = $data['image'];
        $this->available = (bool) $data['available'];
        $this->dateCreation = $data['date_creation'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function getDateCreation(): string
    {
        return $this->dateCreation;
    }
}
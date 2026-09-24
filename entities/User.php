<?php

class User
{
    private int $id;
    private string $pseudo;
    private string $email;
    private string $password;
    private ?string $image;
    private string $dateCreation;

    public function __construct(array $data)
    {
        $this->id = (int) $data['id'];
        $this->pseudo = $data['pseudo'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->image = $data['image'];
        $this->dateCreation = $data['date_creation'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getDateCreation(): string
    {
        return $this->dateCreation;
    }
}
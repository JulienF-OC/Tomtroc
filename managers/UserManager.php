<?php

class UserManager extends AbstractEntityManager
{
    public function getUserByEmail(string $email): ?User
    {
        $query = $this->db->prepare(
            'SELECT *
             FROM `user`
             WHERE email = :email'
        );

        $query->execute([
            'email' => $email
        ]);

        $userData = $query->fetch();

        if (!$userData) {
            return null;
        }

        return new User($userData);
    }

    public function getUserById(int $id): ?User
    {
        $query = $this->db->prepare(
            'SELECT *
             FROM `user`
             WHERE id = :id'
        );

        $query->execute([
            'id' => $id
        ]);

        $userData = $query->fetch();

        if (!$userData) {
            return null;
        }

        return new User($userData);
    }

    public function createUser(
        string $pseudo,
        string $email,
        string $password
    ): void {
        $query = $this->db->prepare(
            'INSERT INTO `user` (pseudo, email, password, image, date_creation)
             VALUES (:pseudo, :email, :password, NULL, NOW())'
        );

        $query->execute([
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $password
        ]);
    }

    public function updateUser(
        int $id,
        string $pseudo,
        string $email
    ): void {
        $query = $this->db->prepare(
            'UPDATE `user`
             SET pseudo = :pseudo,
                 email = :email
             WHERE id = :id'
        );

        $query->execute([
            'id' => $id,
            'pseudo' => $pseudo,
            'email' => $email
        ]);
    }

    public function updateUserImage(
        int $id,
        string $image
    ): void {
        $query = $this->db->prepare(
            'UPDATE `user`
             SET image = :image
             WHERE id = :id'
        );

        $query->execute([
            'id' => $id,
            'image' => $image
        ]);
    }
}
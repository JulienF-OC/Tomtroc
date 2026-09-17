<?php

class BookManager extends AbstractEntityManager
{
    public function getAllBooks(): array
    {
        $query = $this->db->query(
            'SELECT
                b.*,
                u.pseudo AS owner_pseudo
            FROM book b
            INNER JOIN `user` u ON b.id_user = u.id
            ORDER BY b.date_creation DESC'
        );

        $books = [];

        foreach ($query->fetchAll() as $bookData) {
            $books[] = new Book($bookData);
        }

        return $books;
    }

    public function getLatestBooks(): array
    {
        $query = $this->db->query(
            'SELECT
                b.*,
                u.pseudo AS owner_pseudo
            FROM book b
            INNER JOIN `user` u ON b.id_user = u.id
            ORDER BY b.date_creation DESC
            LIMIT 4'
        );

        $books = [];

        foreach ($query->fetchAll() as $bookData) {
            $books[] = new Book($bookData);
        }

        return $books;
    }

    public function getAvailableBooks(string $search = ''): array
    {
        $sql = '
            SELECT
                b.*,
                u.pseudo AS owner_pseudo
            FROM book b
            INNER JOIN `user` u ON b.id_user = u.id
            WHERE b.available = 1
        ';

        if ($search !== '') {
            $sql .= ' AND b.title LIKE :search';
        }

        $sql .= ' ORDER BY b.date_creation DESC';

        $query = $this->db->prepare($sql);

        if ($search !== '') {
            $query->bindValue(
                ':search',
                '%' . $search . '%',
                PDO::PARAM_STR
            );
        }

        $query->execute();

        $books = [];

        foreach ($query->fetchAll() as $bookData) {
            $books[] = new Book($bookData);
        }

        return $books;
    }

    public function getBookById(int $id): ?Book
    {
        $query = $this->db->prepare(
            'SELECT
                b.*,
                u.pseudo AS owner_pseudo
            FROM book b
            INNER JOIN `user` u ON b.id_user = u.id
            WHERE b.id = :id'
        );

        $query->execute([
            'id' => $id
        ]);

        $bookData = $query->fetch();

        if (!$bookData) {
            return null;
        }

        return new Book($bookData);
    }
}
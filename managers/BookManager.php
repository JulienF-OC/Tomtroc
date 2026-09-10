<?php

class BookManager extends AbstractEntityManager
{
    public function getAllBooks(): array
    {
        $query = $this->db->query(
            'SELECT * FROM book ORDER BY date_creation DESC'
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
        'SELECT * FROM book
        ORDER BY date_creation DESC
        LIMIT 4'
    );

    $books = [];

    foreach ($query->fetchAll() as $bookData) {
        $books[] = new Book($bookData);
    }

    return $books;
}
}
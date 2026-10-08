
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

    public function getBooksByUserId(int $userId): array
    {
        $query = $this->db->prepare(
            'SELECT
                b.*,
                u.pseudo AS owner_pseudo
            FROM book b
            INNER JOIN `user` u ON b.id_user = u.id
            WHERE b.id_user = :user_id
            ORDER BY b.date_creation DESC'
        );

        $query->execute([
            'user_id' => $userId
        ]);

        $books = [];

        foreach ($query->fetchAll() as $bookData) {
            $books[] = new Book($bookData);
        }

        return $books;
    }

    /*
     * Ajout d'un nouveau livre dans la base de données.
     */
    public function createBook(
        int $userId,
        string $title,
        string $author,
        string $description,
        string $image,
        int $available
    ): int {
        $query = $this->db->prepare(
            'INSERT INTO book (
                id_user,
                title,
                author,
                description,
                image,
                available,
                date_creation
            ) VALUES (
                :user_id,
                :title,
                :author,
                :description,
                :image,
                :available,
                NOW()
            )'
        );

        $query->execute([
            'user_id' => $userId,
            'title' => $title,
            'author' => $author,
            'description' => $description,
            'image' => $image,
            'available' => $available
        ]);

        return (int) $this->db->lastInsertId();
    }

    /*
     * Modification d'un livre appartenant à l'utilisateur.
     */
    public function updateBook(
        int $bookId,
        int $userId,
        string $title,
        string $author,
        string $description,
        string $image,
        int $available
    ): bool {
        /*
         * La condition id_user empêche de modifier
         * le livre d'un autre utilisateur.
         */
        $query = $this->db->prepare(
            'UPDATE book
            SET
                title = :title,
                author = :author,
                description = :description,
                image = :image,
                available = :available
            WHERE
                id = :book_id
                AND id_user = :user_id'
        );

        return $query->execute([
            'book_id' => $bookId,
            'user_id' => $userId,
            'title' => $title,
            'author' => $author,
            'description' => $description,
            'image' => $image,
            'available' => $available
        ]);
    }

    /*
     * Suppression d'un livre appartenant à l'utilisateur.
     */
    public function deleteBook(int $bookId, int $userId): bool
    {
        /*
         * On utilise une requête préparée pour éviter
         * les injections SQL.
         *
         * La condition id_user garantit qu'un utilisateur
         * ne peut pas supprimer le livre d'un autre.
         */
        $query = $this->db->prepare(
            'DELETE FROM book
            WHERE id = :book_id
            AND id_user = :user_id'
        );

        $query->execute([
            'book_id' => $bookId,
            'user_id' => $userId
        ]);

        /*
         * rowCount() indique combien de livres
         * ont réellement été supprimés.
         */
        return $query->rowCount() > 0;
    }
}

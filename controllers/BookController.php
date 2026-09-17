<?php

class BookController
{
    public function showBooks(): void
    {
        $bookManager = new BookManager();

        $search = trim($_GET['search'] ?? '');

        $books = $bookManager->getAvailableBooks($search);

        $view = new View('books');

        $view->render([
            'books' => $books,
            'search' => $search
        ]);
    }

    public function showBook(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (!$id) {
            http_response_code(404);

            $view = new View('404');
            $view->render();

            return;
        }

        $bookManager = new BookManager();

        $book = $bookManager->getBookById($id);

        if ($book === null) {
            http_response_code(404);

            $view = new View('404');
            $view->render();

            return;
        }

        $view = new View('book');

        $view->render([
            'book' => $book
        ]);
    }
}
<?php

class HomeController
{
    public function showHome(): void
    {
        $bookManager = new BookManager();

        $books = $bookManager->getAllBooks();

        $view = new View('home');

        $view->render([
            'books' => $books
        ]);
    }
}
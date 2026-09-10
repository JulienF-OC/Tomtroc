<?php

class HomeController
{
    public function showHome(): void
    {
        $bookManager = new BookManager();

        $books = $bookManager->getLatestBooks();

        $view = new View('home');

        $view->render([
            'books' => $books
        ]);
    }
}

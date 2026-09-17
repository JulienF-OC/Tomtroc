<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

$action = $_GET['action'] ?? 'home';

try {

    switch ($action) {

        case 'home':

            $homeController = new HomeController();
            $homeController->showHome();

            break;


        case 'books':

            $bookController = new BookController();
            $bookController->showBooks();

            break;


        case 'showBook':

            $bookController = new BookController();
            $bookController->showBook();

            break;


        default:

            http_response_code(404);

            $view = new View('404');
            $view->render();

            break;
    }

} catch (Throwable $exception) {

    echo '<pre>';
    echo htmlspecialchars($exception->getMessage());
    echo '</pre>';
}
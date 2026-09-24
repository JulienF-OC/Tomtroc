<?php

session_start();

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

        case 'register':
            $userController = new UserController();
            $userController->showRegister();
            break;

        case 'login':
            $userController = new UserController();
            $userController->showLogin();
            break;

        case 'account':
            $userController = new UserController();
            $userController->showAccount();
            break;

        case 'profile':
            $userController = new UserController();
            $userController->showProfile();
            break;

        case 'logout':
            $userController = new UserController();
            $userController->logout();
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
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

        default:

            http_response_code(404);

            echo 'Erreur 404 : page introuvable.';

            break;
    }

} catch (Throwable $exception) {

    echo '<pre>';
    echo htmlspecialchars($exception->getMessage());
    echo '</pre>';
}
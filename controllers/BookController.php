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

    /*
     * Affichage et traitement du formulaire d'ajout d'un livre.
     */
    public function addBook(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title = trim($_POST['title'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $available = $_POST['available'] ?? '1';

            $old = [
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'available' => $available
            ];

            if ($title === '') {
                $errors[] = 'Veuillez renseigner le titre du livre.';
            }

            if ($author === '') {
                $errors[] = 'Veuillez renseigner le nom de l’auteur.';
            }

            if (!in_array($available, ['0', '1'], true)) {
                $errors[] = 'La disponibilité sélectionnée est invalide.';
            }

            $image = '';

            $hasImage = isset($_FILES['image'])
                && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE;

            if ($hasImage) {

                if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {

                    $errors[] = 'Une erreur est survenue lors de l’envoi de la photo.';

                } elseif ($_FILES['image']['size'] > 5 * 1024 * 1024) {

                    $errors[] = 'La photo ne doit pas dépasser 5 Mo.';

                } else {

                    $fileInfo = new finfo(FILEINFO_MIME_TYPE);

                    $mimeType = $fileInfo->file(
                        $_FILES['image']['tmp_name']
                    );

                    $allowedTypes = [
                        'image/jpeg' => 'jpg',
                        'image/png' => 'png',
                        'image/webp' => 'webp'
                    ];

                    if (!isset($allowedTypes[$mimeType])) {

                        $errors[] = 'La photo doit être au format JPG, PNG ou WebP.';

                    } else {

                        $extension = $allowedTypes[$mimeType];

                        $fileName = bin2hex(random_bytes(16))
                            . '.' . $extension;

                        $uploadDirectory = __DIR__
                            . '/../public/images/';

                        if (empty($errors)) {

                            if (!is_dir($uploadDirectory)
                                || !is_writable($uploadDirectory)) {

                                $errors[] = 'Le dossier des images est inaccessible.';

                            } elseif (!move_uploaded_file(
                                $_FILES['image']['tmp_name'],
                                $uploadDirectory . $fileName
                            )) {

                                $errors[] = 'Impossible d’enregistrer la photo.';

                            } else {

                                $image = '/TomTroc/public/images/' . $fileName;
                            }
                        }
                    }
                }
            }

            if (empty($errors)) {

                $bookManager = new BookManager();

                try {

                    $bookManager->createBook(
                        (int) $_SESSION['user_id'],
                        $title,
                        $author,
                        $description,
                        $image,
                        (int) $available
                    );

                } catch (Throwable $exception) {

                    if ($image !== '') {

                        $imagePath = __DIR__
                            . '/../public/images/'
                            . basename($image);

                        if (is_file($imagePath)) {
                            unlink($imagePath);
                        }
                    }

                    throw $exception;
                }

                header('Location: index.php?action=account');
                exit;
            }
        }

        $view = new View('addBook');

        $view->render([
            'errors' => $errors,
            'old' => $old
        ]);
    }

    /*
     * Affichage et traitement du formulaire de modification.
     */
    public function editBook(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $bookId = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (!$bookId) {

            http_response_code(404);

            $view = new View('404');
            $view->render();

            return;
        }

        $bookManager = new BookManager();

        $book = $bookManager->getBookById($bookId);

        /*
         * Vérification du propriétaire du livre.
         */
        if (
            $book === null ||
            $book->getIdUser() !== (int) $_SESSION['user_id']
        ) {

            http_response_code(404);

            $view = new View('404');
            $view->render();

            return;
        }

        $errors = [];

        $old = [
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'available' => $book->isAvailable() ? '1' : '0'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title = trim($_POST['title'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $available = $_POST['available'] ?? '';

            $old = [
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'available' => $available
            ];

            if ($title === '') {
                $errors[] = 'Veuillez renseigner le titre du livre.';
            }

            if ($author === '') {
                $errors[] = 'Veuillez renseigner le nom de l’auteur.';
            }

            if (!in_array($available, ['0', '1'], true)) {
                $errors[] = 'La disponibilité sélectionnée est invalide.';
            }

            /*
             * Conservation de la photo actuelle.
             */
            $image = $book->getImage() ?? '';
            $newImagePath = null;

            $hasImage = isset($_FILES['image'])
                && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE;

            if ($hasImage) {

                if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {

                    $errors[] = 'Une erreur est survenue lors de l’envoi de la photo.';

                } elseif ($_FILES['image']['size'] > 5 * 1024 * 1024) {

                    $errors[] = 'La photo ne doit pas dépasser 5 Mo.';

                } else {

                    $fileInfo = new finfo(FILEINFO_MIME_TYPE);

                    $mimeType = $fileInfo->file(
                        $_FILES['image']['tmp_name']
                    );

                    $allowedTypes = [
                        'image/jpeg' => 'jpg',
                        'image/png' => 'png',
                        'image/webp' => 'webp'
                    ];

                    if (!isset($allowedTypes[$mimeType])) {

                        $errors[] = 'La photo doit être au format JPG, PNG ou WebP.';

                    } else {

                        $extension = $allowedTypes[$mimeType];

                        $fileName = bin2hex(random_bytes(16))
                            . '.' . $extension;

                        $uploadDirectory = __DIR__
                            . '/../public/images/';

                        if (empty($errors)) {

                            if (!is_dir($uploadDirectory)
                                || !is_writable($uploadDirectory)) {

                                $errors[] = 'Le dossier des images est inaccessible.';

                            } elseif (!move_uploaded_file(
                                $_FILES['image']['tmp_name'],
                                $uploadDirectory . $fileName
                            )) {

                                $errors[] = 'Impossible d’enregistrer la photo.';

                            } else {

                                $newImagePath = $uploadDirectory . $fileName;
                                $image = '/TomTroc/public/images/' . $fileName;
                            }
                        }
                    }
                }
            }

            if (empty($errors)) {

                try {

                    $updated = $bookManager->updateBook(
                        $bookId,
                        (int) $_SESSION['user_id'],
                        $title,
                        $author,
                        $description,
                        $image,
                        (int) $available
                    );

                    if (!$updated) {
                        $errors[] = 'Impossible de modifier ce livre.';
                    }

                } catch (Throwable $exception) {

                    if (
                        $newImagePath !== null &&
                        is_file($newImagePath)
                    ) {
                        unlink($newImagePath);
                    }

                    throw $exception;
                }

                if (empty($errors)) {

                    header('Location: index.php?action=account');
                    exit;
                }

                if (
                    $newImagePath !== null &&
                    is_file($newImagePath)
                ) {
                    unlink($newImagePath);
                }
            }
        }

        $view = new View('editBook');

        $view->render([
            'book' => $book,
            'errors' => $errors,
            'old' => $old
        ]);
    }

    /*
     * Suppression d'un livre appartenant à l'utilisateur.
     */
    public function deleteBook(): void
    {
        /*
         * Vérification de la connexion.
         */
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        /*
         * La suppression doit obligatoirement
         * être demandée avec la méthode POST.
         */
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Allow: POST');
            return;
        }

        /*
         * Vérification du jeton CSRF.
         */
        $sessionToken = $_SESSION['csrf_token'] ?? '';
        $submittedToken = $_POST['csrf_token'] ?? '';

        if (
            !is_string($sessionToken) ||
            !is_string($submittedToken) ||
            $sessionToken === '' ||
            !hash_equals($sessionToken, $submittedToken)
        ) {
            http_response_code(403);
            echo 'Requête de suppression non autorisée.';
            return;
        }

        /*
         * Récupération de l'identifiant du livre.
         */
        $bookId = filter_input(
            INPUT_POST,
            'book_id',
            FILTER_VALIDATE_INT
        );

        if (!$bookId) {
            http_response_code(400);
            return;
        }

        $bookManager = new BookManager();

        /*
         * Vérification de l'existence du livre
         * et de son propriétaire.
         */
        $book = $bookManager->getBookById($bookId);

        if (
            $book === null ||
            $book->getIdUser() !== (int) $_SESSION['user_id']
        ) {
            http_response_code(404);

            $view = new View('404');
            $view->render();

            return;
        }

        /*
         * Suppression du livre dans la base de données.
         */
        $deleted = $bookManager->deleteBook(
            $bookId,
            (int) $_SESSION['user_id']
        );

        if (!$deleted) {
            http_response_code(404);

            $view = new View('404');
            $view->render();

            return;
        }

        /*
         * Retour vers le compte après suppression.
         */
        header('Location: index.php?action=account');
        exit;
    }
}

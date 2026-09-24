<?php

class UserController
{
    private UserManager $userManager;
    private BookManager $bookManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->bookManager = new BookManager();
    }

    public function showRegister(): void
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $pseudo = trim($_POST['pseudo'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $passwordConfirmation = $_POST['password_confirmation'] ?? '';

            if ($pseudo === '') {
                $errors[] = 'Le pseudo est obligatoire.';
            }

            if ($email === '') {
                $errors[] = 'L\'adresse email est obligatoire.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'L\'adresse email n\'est pas valide.';
            }

            if ($password === '') {
                $errors[] = 'Le mot de passe est obligatoire.';
            }

            if ($password !== $passwordConfirmation) {
                $errors[] = 'Les mots de passe ne correspondent pas.';
            }

            if (empty($errors)) {

                $existingUser = $this->userManager->getUserByEmail($email);

                if ($existingUser !== null) {
                    $errors[] = 'Cette adresse email est déjà utilisée.';
                }
            }

            if (empty($errors)) {

                $hashedPassword = password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );

                $this->userManager->createUser(
                    $pseudo,
                    $email,
                    $hashedPassword
                );

                header('Location: index.php?action=login');
                exit;
            }
        }

        $view = new View('register');

        $view->render([
            'errors' => $errors
        ]);
    }

    public function showLogin(): void
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '') {
                $errors[] = 'L\'adresse email est obligatoire.';
            }

            if ($password === '') {
                $errors[] = 'Le mot de passe est obligatoire.';
            }

            if (empty($errors)) {

                $user = $this->userManager->getUserByEmail($email);

                if (
                    $user === null ||
                    !password_verify($password, $user->getPassword())
                ) {
                    $errors[] = 'Adresse email ou mot de passe incorrect.';
                }
            }

            if (empty($errors)) {

                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_pseudo'] = $user->getPseudo();

                header('Location: index.php?action=home');
                exit;
            }
        }

        $view = new View('login');

        $view->render([
            'errors' => $errors
        ]);
    }

    public function showAccount(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $errors = [];
        $success = '';

        $user = $this->userManager->getUserById(
            $_SESSION['user_id']
        );

        if ($user === null) {
            session_destroy();

            header('Location: index.php?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /*
             * Modification de la photo de profil
             */
            if (isset($_FILES['profile_image'])) {

                if ($_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {

                    $file = $_FILES['profile_image'];

                    $allowedTypes = [
                        'image/jpeg',
                        'image/png',
                        'image/webp'
                    ];

                    $fileType = mime_content_type($file['tmp_name']);

                    if (!in_array($fileType, $allowedTypes, true)) {

                        $errors[] = 'Le fichier doit être une image JPG, PNG ou WEBP.';

                    } else {

                        $extension = match ($fileType) {
                            'image/jpeg' => 'jpg',
                            'image/png' => 'png',
                            'image/webp' => 'webp'
                        };

                        $fileName = 'profile_' . $user->getId() . '.' . $extension;

                        $uploadDirectory = __DIR__ . '/../public/images/';

                        $uploadPath = $uploadDirectory . $fileName;

                        if (move_uploaded_file(
                            $file['tmp_name'],
                            $uploadPath
                        )) {

                            $imagePath = '/TomTroc/public/images/' . $fileName;

                            $this->userManager->updateUserImage(
                                $user->getId(),
                                $imagePath
                            );

                            $success = 'Votre photo de profil a bien été modifiée.';

                            $user = $this->userManager->getUserById(
                                $user->getId()
                            );

                        } else {

                            $errors[] = 'Impossible d\'enregistrer la photo.';
                        }
                    }

                } elseif ($_FILES['profile_image']['error'] !== UPLOAD_ERR_NO_FILE) {

                    $errors[] = 'Une erreur est survenue lors de l\'envoi de la photo.';
                }
            }

            /*
             * Modification du pseudo et de l'adresse email
             */
            if (
                isset($_POST['pseudo']) &&
                isset($_POST['email'])
            ) {

                $pseudo = trim($_POST['pseudo']);
                $email = trim($_POST['email']);

                if ($pseudo === '') {
                    $errors[] = 'Le pseudo est obligatoire.';
                }

                if ($email === '') {
                    $errors[] = 'L\'adresse email est obligatoire.';
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = 'L\'adresse email n\'est pas valide.';
                }

                if (empty($errors)) {

                    $existingUser = $this->userManager->getUserByEmail($email);

                    if (
                        $existingUser !== null &&
                        $existingUser->getId() !== $user->getId()
                    ) {
                        $errors[] = 'Cette adresse email est déjà utilisée.';
                    }
                }

                if (empty($errors)) {

                    $this->userManager->updateUser(
                        $user->getId(),
                        $pseudo,
                        $email
                    );

                    $_SESSION['user_pseudo'] = $pseudo;

                    $success = 'Vos informations ont bien été enregistrées.';

                    $user = $this->userManager->getUserById(
                        $user->getId()
                    );
                }
            }
        }

        $books = $this->bookManager->getBooksByUserId(
            $_SESSION['user_id']
        );

        $view = new View('account');

        $view->render([
            'user' => $user,
            'books' => $books,
            'errors' => $errors,
            'success' => $success
        ]);
    }

    public function showProfile(): void
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

        $user = $this->userManager->getUserById($id);

        if ($user === null) {
            http_response_code(404);

            $view = new View('404');
            $view->render();

            return;
        }

        $books = $this->bookManager->getBooksByUserId($id);

        $view = new View('profile');

        $view->render([
            'user' => $user,
            'books' => $books
        ]);
    }

    public function logout(): void
    {
        session_destroy();

        header('Location: index.php?action=home');
        exit;
    }
}
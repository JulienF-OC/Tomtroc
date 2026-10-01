<?php

class MessageController
{
    private MessageManager $messageManager;
    private UserManager $userManager;

    public function __construct()
    {
        $this->messageManager = new MessageManager();
        $this->userManager = new UserManager();
    }

    public function showConversation(): void
    {
        /*
         * L'utilisateur doit être connecté pour accéder
         * à une conversation.
         */
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        /*
         * Récupération de l'id de l'utilisateur
         * avec lequel on souhaite discuter.
         */
        $receiverId = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (!$receiverId) {
            http_response_code(404);

            $view = new View('404');
            $view->render();

            return;
        }

        /*
         * On vérifie que cet utilisateur existe.
         */
        $receiver = $this->userManager->getUserById($receiverId);

        if ($receiver === null) {
            http_response_code(404);

            $view = new View('404');
            $view->render();

            return;
        }

        /*
         * On empêche l'utilisateur de démarrer
         * une conversation avec lui-même.
         */
        if ($receiverId === (int) $_SESSION['user_id']) {
            header('Location: index.php?action=account');
            exit;
        }

        $errors = [];

        /*
         * Envoi d'un nouveau message.
         */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $content = trim($_POST['content'] ?? '');

            if ($content === '') {
                $errors[] = 'Le message ne peut pas être vide.';
            }

            if (empty($errors)) {

                $this->messageManager->createMessage(
                    (int) $_SESSION['user_id'],
                    $receiverId,
                    $content
                );

                header(
                    'Location: index.php?action=conversation&id=' . $receiverId
                );
                exit;
            }
        }

        /*
         * Récupération des messages de la conversation ouverte.
         */
        $messages = $this->messageManager->getMessagesBetweenUsers(
            (int) $_SESSION['user_id'],
            $receiverId
        );

        /*
         * Récupération de toutes les conversations
         * de l'utilisateur connecté.
         */
        $conversations = $this->messageManager->getConversationsByUserId(
            (int) $_SESSION['user_id']
        );

        $view = new View('conversation');

        $view->render([
            'receiver' => $receiver,
            'messages' => $messages,
            'conversations' => $conversations,
            'errors' => $errors
        ]);
    }
}
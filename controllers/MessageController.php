
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

    /*
     * Affichage général de la messagerie.
     */
    public function showMessages(): void
    {
        /*
         * L'utilisateur doit être connecté.
         */
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        /*
         * On récupère les conversations de l'utilisateur.
         */
        $conversations = $this->messageManager->getConversationsByUserId(
            (int) $_SESSION['user_id']
        );

        /*
         * Si une conversation existe, on ouvre la plus récente.
         */
        if (!empty($conversations)) {
            $receiverId = (int) $conversations[0]['user_id'];

            header(
                'Location: index.php?action=conversation&id=' . $receiverId
            );
            exit;
        }

        /*
         * Si aucune conversation n'existe,
         * on affiche la page de messagerie vide.
         */
        $view = new View('messages');

        $view->render([
            'conversations' => $conversations
        ]);
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
         * NOUVEAU :
         * On marque comme lus uniquement les messages
         * reçus de l'utilisateur dont la conversation
         * est actuellement ouverte.
         */
        $this->messageManager->markMessagesAsRead(
            (int) $_SESSION['user_id'],
            $receiverId
        );

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

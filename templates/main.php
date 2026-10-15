<?php

/*
 * Compteur de messages non lus.
 *
 * On effectue cette recherche uniquement
 * lorsque l'utilisateur est connecté.
 */
$unreadMessagesCount = 0;

if (isset($_SESSION['user_id'])) {

    $messageManager = new MessageManager();

    $unreadMessagesCount = $messageManager->countUnreadMessages(
        (int) $_SESSION['user_id']
    );
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TomTroc</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="/TomTroc/public/css/style.css"
    >

</head>

<body>

<header class="main-header">

    <nav class="container navbar navbar-expand-lg">

        <a
            href="index.php?action=home"
            class="logo navbar-brand d-flex align-items-center text-decoration-none"
        >
            <span class="logo-icon">TT</span>
            <span class="logo-text">Tom Troc</span>
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#tomtroc-navigation"
            aria-controls="tomtroc-navigation"
            aria-expanded="false"
            aria-label="Ouvrir le menu de navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="tomtroc-navigation">

            <div class="main-navigation d-flex flex-column flex-lg-row">

                <a href="index.php?action=home">
                    Accueil
                </a>

                <a href="index.php?action=books">
                    Nos livres à l'échange
                </a>

            </div>

            <div class="account-navigation d-flex flex-column flex-lg-row ms-lg-auto">

                <?php if (isset($_SESSION['user_id'])): ?>

                    <a href="index.php?action=messages" class="nav-messages-link">
                        <i class="fa-regular fa-comment"></i>
                        Messagerie

                        <?php if ($unreadMessagesCount > 0): ?>

                            <span
                                class="messages-notification-badge"
                                aria-label="<?= $unreadMessagesCount ?> messages non lus"
                            >
                                <?= $unreadMessagesCount ?>
                            </span>

                        <?php endif; ?>

                    </a>

                    <a href="index.php?action=account">
                        <i class="fa-regular fa-user"></i>
                        Mon compte
                    </a>

                    <a href="index.php?action=logout">
                        Déconnexion
                    </a>

                <?php else: ?>

                    <a href="index.php?action=login">
                        Connexion
                    </a>

                <?php endif; ?>

            </div>

        </div>

    </nav>

</header>

<main>
    <?= $content ?>
</main>

<footer class="main-footer">

    <div class="container d-flex justify-content-end align-items-center">

        <a href="#">Politique de confidentialité</a>

        <a href="#">Mentions légales</a>

        <span>Tom Troc®</span>

        <span class="footer-logo">
            T<small>T</small>
        </span>

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

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

    <nav class="container d-flex align-items-center">

        <a
            href="index.php?action=home"
            class="logo d-flex align-items-center text-decoration-none"
        >
            <span class="logo-icon">TT</span>
            <span class="logo-text">Tom Troc</span>
        </a>

        <div class="main-navigation d-flex">

            <a href="index.php?action=home">
                Accueil
            </a>

            <a href="index.php?action=books">
                Nos livres à l'échange
            </a>

        </div>

        <div class="account-navigation d-flex ms-auto">

            <a href="index.php?action=messages">
                <i class="fa-regular fa-comment"></i>
                Messagerie
            </a>

            <a href="index.php?action=account">
                <i class="fa-regular fa-user"></i>
                Mon compte
            </a>

            <a href="index.php?action=login">
                Connexion
            </a>

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

</body>

</html>
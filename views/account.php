<section class="account-page">

    <div class="container">

        <h1 class="account-title">
            Mon compte
        </h1>

        <div class="account-top">

            <!-- Profil -->
            <div class="account-profile">

                <div class="profile-picture">

                    <?php if ($user->getImage()): ?>

                        <img
                            src="<?= htmlspecialchars($user->getImage()) ?>"
                            alt="Photo de profil"
                        >

                    <?php else: ?>

                        <div class="profile-placeholder">
                            <?= strtoupper(substr($user->getPseudo(), 0, 1)) ?>
                        </div>

                    <?php endif; ?>

                </div>

                <form
                    action="index.php?action=account"
                    method="POST"
                    enctype="multipart/form-data"
                    class="profile-image-form"
                >

                    <label
                        for="profile_image"
                        class="profile-edit"
                    >
                        modifier
                    </label>

                    <input
                        type="file"
                        id="profile_image"
                        name="profile_image"
                        accept="image/jpeg,image/png,image/webp"
                        hidden
                    >

                    <button
                        type="submit"
                        class="profile-image-submit"
                    >
                        Enregistrer la photo
                    </button>

                </form>

                <div class="profile-separator"></div>

                <h2>
                    <?= htmlspecialchars($user->getPseudo()) ?>
                </h2>

                <p class="profile-date">
                    Membre depuis
                    <?= date('Y', strtotime($user->getDateCreation())) ?>
                </p>

                <p class="profile-library-title">
                    BIBLIOTHÈQUE
                </p>

                <p class="profile-library">
                    <i class="fa-solid fa-book-open"></i>
                    <?= count($books) ?> livres
                </p>

            </div>

            <!-- Informations personnelles -->
            <div class="account-informations">

                <h2>
                    Vos informations personnelles
                </h2>

                <?php if (!empty($errors)): ?>

                    <div class="alert alert-danger account-alert">

                        <ul>

                            <?php foreach ($errors as $error): ?>

                                <li>
                                    <?= htmlspecialchars($error) ?>
                                </li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                <?php endif; ?>

                <?php if ($success !== ''): ?>

                    <div class="alert alert-success account-alert">
                        <?= htmlspecialchars($success) ?>
                    </div>

                <?php endif; ?>

                <form
                    action="index.php?action=account"
                    method="POST"
                >

                    <div class="account-form-group">

                        <label for="email">
                            Adresse email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?= htmlspecialchars($user->getEmail()) ?>"
                        >

                    </div>

                    <div class="account-form-group">

                        <label for="password">
                            Mot de passe
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            value="********"
                            disabled
                        >

                    </div>

                    <div class="account-form-group">

                        <label for="pseudo">
                            Pseudo
                        </label>

                        <input
                            type="text"
                            id="pseudo"
                            name="pseudo"
                            value="<?= htmlspecialchars($user->getPseudo()) ?>"
                        >

                    </div>

                    <button
                        type="submit"
                        class="account-save"
                    >
                        Enregistrer
                    </button>

                </form>

            </div>

        </div>

        <!-- Bibliothèque -->
        <div class="account-library">

            <div class="account-library-header">

                <h2>
                    Vos livres
                </h2>

            </div>

            <?php if (empty($books)): ?>

                <div class="account-library-empty">

                    <p>
                        Vous n'avez pas encore ajouté de livre.
                    </p>

                </div>

            <?php else: ?>

                <div class="account-books-table">

                    <div class="account-books-head">

                        <span>
                            Livre
                        </span>

                        <span>
                            Auteur
                        </span>

                        <span>
                            Description
                        </span>

                        <span>
                            Disponibilité
                        </span>

                        <span>
                            Actions
                        </span>

                    </div>

                    <?php foreach ($books as $book): ?>

                        <div class="account-book-row">

                            <div class="account-book-info">

                                <img
                                    src="/TomTroc/public/images/<?= htmlspecialchars($book->getImage()) ?>"
                                    alt="<?= htmlspecialchars($book->getTitle()) ?>"
                                >

                                <span>
                                    <?= htmlspecialchars($book->getTitle()) ?>
                                </span>

                            </div>

                            <div>
                                <?= htmlspecialchars($book->getAuthor()) ?>
                            </div>

                            <div>
                                <?= htmlspecialchars($book->getDescription()) ?>
                            </div>

                            <div>

                                <?php if ($book->isAvailable()): ?>

                                    <span class="book-available">
                                        Disponible
                                    </span>

                                <?php else: ?>

                                    <span class="book-unavailable">
                                        Non disponible
                                    </span>

                                <?php endif; ?>

                            </div>

                            <div class="account-book-actions">

                                <a href="#">
                                    Éditer
                                </a>

                                <a href="#">
                                    Supprimer
                                </a>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</section>
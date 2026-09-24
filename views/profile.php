<section class="public-profile-page">

    <div class="container">

        <div class="public-profile-content">

            <!-- Profil -->
            <div class="public-profile-card">

                <div class="public-profile-picture">

                    <?php if ($user->getImage()): ?>

                        <img
                            src="<?= htmlspecialchars($user->getImage()) ?>"
                            alt="Photo de profil"
                        >

                    <?php else: ?>

                        <div class="public-profile-placeholder">
                            <?= strtoupper(substr($user->getPseudo(), 0, 1)) ?>
                        </div>

                    <?php endif; ?>

                </div>

                <div class="public-profile-separator"></div>

                <h1>
                    <?= htmlspecialchars($user->getPseudo()) ?>
                </h1>

                <p class="public-profile-date">
                    Membre depuis 1 an
                </p>

                <p class="public-profile-library-title">
                    BIBLIOTHÈQUE
                </p>

                <p class="public-profile-library">
                    <i class="fa-solid fa-book-open"></i>
                    <?= count($books) ?> livres
                </p>

                <a
                    href="index.php?action=conversation&id=<?= $user->getId() ?>"
                    class="public-profile-message"
                >
                    Écrire un message
                </a>

            </div>


            <!-- Livres -->
            <div class="public-profile-books">

                <div class="public-profile-books-header">

                    <span>
                        PHOTO
                    </span>

                    <span>
                        TITRE
                    </span>

                    <span>
                        AUTEUR
                    </span>

                    <span>
                        DESCRIPTION
                    </span>

                </div>

                <?php foreach ($books as $book): ?>

                    <a
                        href="index.php?action=showBook&id=<?= $book->getId() ?>"
                        class="public-profile-book-row"
                    >

                        <div class="public-profile-book-image">

                            <?php if ($book->getImage() !== null): ?>

                                <img
                                    src="<?= htmlspecialchars($book->getImage()) ?>"
                                    alt="<?= htmlspecialchars($book->getTitle()) ?>"
                                >

                            <?php else: ?>

                                <span>
                                    Pas d'image
                                </span>

                            <?php endif; ?>

                        </div>

                        <div class="public-profile-book-title">
                            <?= htmlspecialchars($book->getTitle()) ?>
                        </div>

                        <div class="public-profile-book-author">
                            <?= htmlspecialchars($book->getAuthor()) ?>
                        </div>

                        <div class="public-profile-book-description">
                            <?= htmlspecialchars(
                                $book->getDescription() ?? ''
                            ) ?>
                        </div>

                    </a>

                <?php endforeach; ?>

                <?php if (empty($books)): ?>

                    <div class="public-profile-no-books">
                        Cet utilisateur n'a pas encore ajouté de livre.
                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</section>
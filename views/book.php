<section class="book-detail row g-0">

    <div class="book-detail-image col-12 col-md-6">

        <?php if ($book->getImage() !== null): ?>

            <img
                src="<?= htmlspecialchars($book->getImage()) ?>"
                alt="<?= htmlspecialchars($book->getTitle()) ?>"
                class="img-fluid"
            >

        <?php else: ?>

            <div class="book-detail-no-image">
                Pas d'image
            </div>

        <?php endif; ?>

    </div>


    <div class="book-detail-content col-12 col-md-6">

        <div class="book-detail-inner">

            <h1>
                <?= htmlspecialchars($book->getTitle()) ?>
            </h1>

            <p class="book-detail-author">
                par <?= htmlspecialchars($book->getAuthor()) ?>
            </p>

            <hr>

            <h2>Description</h2>

            <p class="book-description">
                <?= nl2br(
                    htmlspecialchars(
                        $book->getDescription() ?? ''
                    )
                ) ?>
            </p>


            <h2>Propriétaire</h2>

            <a
                href="index.php?action=profile&id=<?= $book->getIdUser() ?>"
                class="book-owner-profile"
            >
                <?php if ($book->getOwnerImage()): ?>
                    <img
                        src="<?= htmlspecialchars($book->getOwnerImage(), ENT_QUOTES, 'UTF-8') ?>"
                        alt="Photo de profil du propriétaire"
                        class="book-owner-avatar"
                    >
                <?php else: ?>
                    <span class="book-owner-avatar-placeholder" aria-hidden="true">👤</span>
                <?php endif; ?>

                <span>
                    <?= htmlspecialchars(
                        $book->getOwnerPseudo()
                        ?? 'Utilisateur inconnu'
                    ) ?>
                </span>
            </a>


            <a
                href="index.php?action=conversation&id=<?= $book->getIdUser() ?>"
                class="btn-tomtroc book-message-button"
            >
                Envoyer un message
            </a>

        </div>

    </div>

</section>

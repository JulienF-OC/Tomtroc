<section class="book-detail">

    <div class="book-detail-image">

        <?php if ($book->getImage() !== null): ?>

            <img
                src="<?= htmlspecialchars($book->getImage()) ?>"
                alt="<?= htmlspecialchars($book->getTitle()) ?>"
            >

        <?php else: ?>

            <div class="book-detail-no-image">
                Pas d'image
            </div>

        <?php endif; ?>

    </div>


    <div class="book-detail-content">

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
                <?= htmlspecialchars(
                    $book->getOwnerPseudo()
                    ?? 'Utilisateur inconnu'
                ) ?>
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
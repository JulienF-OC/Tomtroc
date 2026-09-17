<section class="books-page">

    <div class="container">

        <div class="books-header">

            <h1>Nos livres à l'échange</h1>

            <form
    action="index.php"
    method="GET"
    class="book-search-form"
>

    <input
        type="hidden"
        name="action"
        value="books"
    >

    <div class="search-wrapper">

        <i class="fa-solid fa-magnifying-glass search-icon"></i>

        <input
            type="search"
            name="search"
            value="<?= htmlspecialchars($search) ?>"
            placeholder="Rechercher un livre"
            class="book-search-input"
        >

    </div>

</form>

        </div>


        <?php if (empty($books)): ?>

            <p class="no-books">
                Aucun livre ne correspond à votre recherche.
            </p>

        <?php else: ?>

            <div class="row books-grid">

                <?php foreach ($books as $book): ?>

                    <div class="col-md-3">

                        <a
                            href="index.php?action=showBook&id=<?= $book->getId() ?>"
                            class="book-link"
                        >

                            <article class="book-card">

                                <?php if ($book->getImage() !== null): ?>

                                    <img
                                        src="<?= htmlspecialchars($book->getImage()) ?>"
                                        alt="<?= htmlspecialchars($book->getTitle()) ?>"
                                        class="book-image"
                                    >

                                <?php else: ?>

                                    <div class="book-image book-image-empty">
                                        Pas d'image
                                    </div>

                                <?php endif; ?>


                                <div class="book-information">

                                    <h2>
                                        <?= htmlspecialchars($book->getTitle()) ?>
                                    </h2>

                                    <p class="book-author">
                                        <?= htmlspecialchars($book->getAuthor()) ?>
                                    </p>

                                    <p class="book-owner">
                                        Vendu par :
                                        <?= htmlspecialchars(
                                            $book->getOwnerPseudo()
                                            ?? 'Utilisateur inconnu'
                                        ) ?>
                                    </p>

                                </div>

                            </article>

                        </a>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>

</section>
<h2>Nos livres</h2>

<?php if (empty($books)): ?>

    <p>Aucun livre n'est actuellement enregistré.</p>

<?php else: ?>

    <?php foreach ($books as $book): ?>

        <article>

            <h3>
                <?= htmlspecialchars($book->getTitle()) ?>
            </h3>

            <p>
                Auteur :
                <?= htmlspecialchars($book->getAuthor()) ?>
            </p>

            <p>
                <?= htmlspecialchars($book->getDescription() ?? '') ?>
            </p>

            <p>
                <?= $book->isAvailable()
                    ? 'Disponible'
                    : 'Non disponible'
                ?>
            </p>

        </article>

    <?php endforeach; ?>

<?php endif; ?>

<section class="book-form-page">

    <div class="container">

        <a href="index.php?action=account" class="book-form-back">
            ← retour
        </a>

        <h1 class="book-form-title">
            Ajouter un livre
        </h1>

        <div class="book-form-container">

            <?php if (!empty($errors)): ?>

                <div class="alert alert-danger">

                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li>
                                <?= htmlspecialchars($error) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>

            <?php endif; ?>

            <form
                action="index.php?action=addBook"
                method="POST"
                enctype="multipart/form-data"
                class="book-form"
            >

                <!-- Colonne gauche : photo -->
                <div class="book-form-photo">

                    <label for="book_image">
                        Photo
                    </label>

                    <div class="book-form-photo-placeholder">

                        <i class="fa-regular fa-image"></i>

                        <p>
                            Aucune photo sélectionnée
                        </p>

                    </div>

                    <label for="book_image" class="book-form-photo-link">
                        Ajouter une photo
                    </label>

                    <input
                        type="file"
                        id="book_image"
                        name="image"
                        accept="image/jpeg,image/png,image/webp"
                    >

                    <p class="book-form-photo-help">
                        La photo est facultative.
                    </p>

                </div>

                <!-- Colonne droite : informations -->
                <div class="book-form-fields">

                    <div class="book-form-group">

                        <label for="title">
                            Titre
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="<?= htmlspecialchars($old['title'] ?? '') ?>"
                            required
                        >

                    </div>

                    <div class="book-form-group">

                        <label for="author">
                            Auteur
                        </label>

                        <input
                            type="text"
                            id="author"
                            name="author"
                            value="<?= htmlspecialchars($old['author'] ?? '') ?>"
                            required
                        >

                    </div>

                    <div class="book-form-group">

                        <label for="description">
                            Commentaire
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="10"
                        ><?= htmlspecialchars($old['description'] ?? '') ?></textarea>

                    </div>

                    <div class="book-form-group">

                        <label for="available">
                            Disponibilité
                        </label>

                        <select
                            id="available"
                            name="available"
                        >
                            <option
                                value="1"
                                <?= (string) ($old['available'] ?? '1') === '1' ? 'selected' : '' ?>
                            >
                                disponible
                            </option>

                            <option
                                value="0"
                                <?= (string) ($old['available'] ?? '1') === '0' ? 'selected' : '' ?>
                            >
                                non disponible
                            </option>

                        </select>

                    </div>

                    <button type="submit" class="book-form-submit">
                        Ajouter le livre
                    </button>

                </div>

            </form>

        </div>

    </div>

</section>

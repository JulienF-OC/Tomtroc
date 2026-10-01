<section class="auth-page">

    <div class="auth-content">

        <div class="auth-form">

            <h1>Inscription</h1>

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
                action="index.php?action=register"
                method="POST"
            >

                <div class="form-group">

                    <label for="pseudo">
                        Pseudo
                    </label>

                    <input
                        type="text"
                        id="pseudo"
                        name="pseudo"
                        value="<?= htmlspecialchars($_POST['pseudo'] ?? '') ?>"
                    >

                </div>

                <div class="form-group">

                    <label for="email">
                        Adresse email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                    >

                </div>

                <div class="form-group">

                    <label for="password">
                        Mot de passe
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                    >

                </div>

                <div class="form-group">

                    <label for="password_confirmation">
                        Confirmation du mot de passe
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                    >

                </div>

                <button
                    type="submit"
                    class="btn-tomtroc"
                >
                    S'inscrire
                </button>

            </form>

            <p class="auth-link">
                Déjà inscrit ?
                <a href="index.php?action=login">
                    Connectez-vous
                </a>
            </p>

        </div>

        <div class="auth-image">

            <img
                src="/TomTroc/public/images/auth-books.jpg"
                alt="Livres"
            >

        </div>

    </div>

</section>
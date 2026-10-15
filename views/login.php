<section class="auth-page">

    <div class="auth-content row g-0">

        <div class="auth-form col-12 col-lg-7">

            <h1>Connexion</h1>

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
                action="index.php?action=login"
                method="POST"
            >

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

                <button
                    type="submit"
                    class="btn-tomtroc"
                >
                    Se connecter
                </button>

            </form>

            <p class="auth-link">
                Pas de compte ?
                <a href="index.php?action=register">
                    Inscrivez-vous
                </a>
            </p>

        </div>

        <div class="auth-image col-12 col-lg-5">

            <img
                src="/TomTroc/public/images/auth-books.jpg"
                alt="Livres"
            >

        </div>

    </div>

</section>

<!-- HERO -->

<section class="home-hero">

    <div class="container">

        <div class="row align-items-center hero-content">

            <div class="col-md-6">

                <div class="hero-text">

                    <h1>
                        Rejoignez nos<br>
                        lecteurs passionnés
                    </h1>

                    <p>
                        Donnez une nouvelle vie à vos livres en les
                        échangeant avec d'autres amoureux de la lecture.
                        Nous croyons en la magie du partage de connaissances
                        et d'histoires à travers les livres.
                    </p>

                    <a
                        href="index.php?action=books"
                        class="btn-tomtroc"
                    >
                        Découvrir
                    </a>

                </div>

            </div>


            <div class="col-md-6">

                <div class="hero-image">

                    <img
                        src="/TomTroc/public/images/home-hero.png"
                        alt="Librairie remplie de livres"
                    >

                    <span>Hamza</span>

                </div>

            </div>

        </div>

    </div>

</section>



<!-- DERNIERS LIVRES -->

<section class="latest-books">

    <div class="container">

        <h2>Les derniers livres ajoutés</h2>

        <div class="row justify-content-center">

            <?php foreach ($books as $book): ?>

                <div class="col-md-3">

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

                            <h3>
                                <?= htmlspecialchars($book->getTitle()) ?>
                            </h3>

                            <p class="book-author">
                                <?= htmlspecialchars($book->getAuthor()) ?>
                            </p>

                            <p class="book-owner">
                                Vendu par : utilisateur
                            </p>

                        </div>

                    </article>

                </div>

            <?php endforeach; ?>

        </div>


        <div class="text-center">

            <a
                href="index.php?action=books"
                class="btn-tomtroc"
            >
                Voir tous les livres
            </a>

        </div>

    </div>

</section>



<!-- COMMENT ÇA MARCHE -->

<section class="how-it-works">

    <div class="container">

        <h2>Comment ça marche ?</h2>

        <p class="section-description">
            Échanger des livres avec TomTroc c'est simple et amusant !
            Suivez ces étapes pour commencer :
        </p>


        <div class="row justify-content-center">

            <div class="col-md-3">

                <div class="step-card">
                    Inscrivez-vous gratuitement sur notre plateforme.
                </div>

            </div>


            <div class="col-md-3">

                <div class="step-card">
                    Ajoutez les livres que vous souhaitez échanger à votre profil.
                </div>

            </div>


            <div class="col-md-3">

                <div class="step-card">
                    Parcourez les livres disponibles chez d'autres membres.
                </div>

            </div>


            <div class="col-md-3">

                <div class="step-card">
                    Proposez un échange et discutez avec d'autres passionnés de lecture.
                </div>

            </div>

        </div>


        <div class="text-center">

            <a
                href="index.php?action=books"
                class="btn-tomtroc btn-outline-tomtroc"
            >
                Voir tous les livres
            </a>

        </div>

    </div>

</section>



<!-- GRANDE IMAGE -->

<section class="home-banner">

    <img
        src="/TomTroc/public/images/home-banner.png"
        alt="Bibliothèque remplie de livres"
    >

</section>



<!-- NOS VALEURS -->

<section class="our-values">

    <div class="values-content">

        <h2>Nos valeurs</h2>

        <p>
            Chez Tom Troc, nous mettons l'accent sur le partage,
            la découverte et la communauté. Nos valeurs sont ancrées
            dans notre passion pour les livres et notre désir de créer
            des liens entre les lecteurs. Nous croyons en la puissance
            des histoires pour rassembler les gens et inspirer des
            conversations enrichissantes.
        </p>

        <p>
            Notre association a été fondée avec une conviction
            profonde : chaque livre mérite d'être lu et partagé.
        </p>

        <p>
            Nous sommes passionnés par la création d'une plateforme
            conviviale qui permet aux lecteurs de se connecter,
            de partager leurs découvertes littéraires et d'échanger
            des livres qui attendent patiemment sur les étagères.
        </p>

        <span class="team">
            L'équipe Tom Troc
        </span>

        <div class="heart">
            ♡
        </div>

    </div>

</section>
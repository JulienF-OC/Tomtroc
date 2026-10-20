<!-- HERO -->

<section class="home-hero">

    <div class="container">

        <div class="row align-items-center hero-content g-4">

            <div class="col-12 col-md-6 order-2 order-md-1">

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
                        class="btn-tomtroc d-block d-md-inline-block text-center"
                    >
                        Découvrir
                    </a>

                </div>

            </div>

            <div class="col-12 col-md-6 order-1 order-md-2">

                <div class="hero-image">

                    <img
                        src="/TomTroc/public/images/home-hero.png"
                        alt="Librairie remplie de livres"
                        class="img-fluid"
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

        <div class="row justify-content-center g-3 g-md-4">

            <?php foreach ($books as $book): ?>

                <div class="col-6 col-md-3">

                    <article class="book-card h-100">

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
                                Vendu par :
                                <?= htmlspecialchars(
                                    $book->getOwnerPseudo() ?? 'Utilisateur inconnu'
                                ) ?>
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

        <div class="row justify-content-center g-4">

            <div class="col-12 col-md-3">

                <div class="step-card h-100">
                    Inscrivez-vous gratuitement sur notre plateforme.
                </div>

            </div>

            <div class="col-12 col-md-3">

                <div class="step-card h-100">
                    Ajoutez les livres que vous souhaitez échanger à votre profil.
                </div>

            </div>

            <div class="col-12 col-md-3">

                <div class="step-card h-100">
                    Parcourez les livres disponibles chez d'autres membres.
                </div>

            </div>

            <div class="col-12 col-md-3">

                <div class="step-card h-100">
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
        class="img-fluid"
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

        <div class="heart" aria-hidden="true">
            <svg width="122" height="104" viewBox="0 0 122 104" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M60.8425 80.2508C42.6875 89.5596 22.5734 96.4166 7.64535 96.4799C6.2879 96.4857 2.29696 95.8231 1 96.2239M60.8425 80.2508C75.03 72.9763 88.0212 64.2046 96.4064 56.0077C109.127 40.7678 119.928 7.80676 85.8057 2.24498C76.7854 0.774727 68.884 5.20869 63.8016 11.2171M60.8425 80.2508C3.77333 38.8722 16.5387 7.4385 35.3463 2.24498C39.5921 0.193944 51.0577 -0.744118 63.8016 11.2171M60.8425 80.2508C64.2463 82.7187 67.8985 85.222 71.8127 87.7573C96.4064 103.687 121 102.997 121 102.997M63.8016 11.2171C57.1771 19.0485 55.3417 29.5548 62.0601 33.1479C66.0177 35.2646 78.2579 25.6127 65.0283 12.4049C64.6182 11.9955 64.2093 11.5997 63.8016 11.2171Z" stroke-width="2" stroke-linecap="round" stroke="#00AC66"/>
</svg>
        </div>

    </div>

</section>

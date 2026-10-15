<section class="messages-page messages-list-page <?= empty($conversations) ? 'is-empty' : '' ?>">

    <div class="messages-layout">

        <aside class="messages-sidebar">

            <h1>Messagerie</h1>

            <div class="messages-conversations">
                <?php if (!empty($conversations)): ?>

                    <?php foreach ($conversations as $conversation): ?>

                        <a
                            href="index.php?action=conversation&id=<?= (int) $conversation['user_id'] ?>"
                            class="messages-conversation-item"
                        >

                            <div class="messages-conversation-picture">

                                <?php if (!empty($conversation['image'])): ?>

                                    <img
                                        src="<?= htmlspecialchars($conversation['image']) ?>"
                                        alt="Photo de profil"
                                    >

                                <?php else: ?>

                                    <div class="messages-conversation-placeholder">
                                        <?= strtoupper(substr($conversation['pseudo'], 0, 1)) ?>
                                    </div>

                                <?php endif; ?>

                            </div>

                            <div class="messages-conversation-info">

                                <div class="messages-conversation-top">

                                    <span class="messages-conversation-pseudo">
                                        <?= htmlspecialchars($conversation['pseudo']) ?>
                                    </span>

                                    <span class="messages-conversation-time">
                                        <?= date('H:i', strtotime($conversation['date_creation'])) ?>
                                    </span>

                                </div>

                                <div class="messages-conversation-preview">
                                    <?= htmlspecialchars(mb_strimwidth($conversation['content'], 0, 35, '...')) ?>
                                </div>

                            </div>

                        </a>

                    <?php endforeach; ?>

                <?php else: ?>
                    <!-- Aucune conversation pour le moment -->
                <?php endif; ?>
            </div>

        </aside>

        <div class="messages-main">

            <?php if (empty($conversations)): ?>

                <div class="messages-empty">

                    <p>
                        Vous n'avez aucune conversation pour le moment.
                    </p>

                    <p>
                        Rendez-vous sur le profil d'un utilisateur
                        pour lui envoyer un message.
                    </p>

                    <a href="index.php?action=books">
                        Découvrir les livres
                    </a>

                </div>

            <?php else: ?>

                <div class="messages-empty messages-select-conversation">
                    <p>Sélectionnez une conversation pour afficher les messages.</p>
                </div>

            <?php endif; ?>

        </div>

    </div>

</section>

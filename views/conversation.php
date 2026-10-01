<section class="messages-page">

    <div class="messages-layout">

        <!-- =========================
             COLONNE GAUCHE
             Liste des conversations
        ========================== -->
        <aside class="messages-sidebar">

            <h1>Messagerie</h1>

            <div class="messages-conversations">

                <?php foreach ($conversations as $conversation): ?>

                    <a
                        href="index.php?action=conversation&id=<?= (int) $conversation['user_id'] ?>"
                        class="messages-conversation-item
                        <?= (int) $conversation['user_id'] === $receiver->getId()
                            ? 'active'
                            : ''
                        ?>"
                    >

                        <div class="messages-conversation-picture">

                            <?php if (!empty($conversation['image'])): ?>

                                <img
                                    src="<?= htmlspecialchars($conversation['image']) ?>"
                                    alt="Photo de profil"
                                >

                            <?php else: ?>

                                <div class="messages-conversation-placeholder">
                                    <?= strtoupper(
                                        substr($conversation['pseudo'], 0, 1)
                                    ) ?>
                                </div>

                            <?php endif; ?>

                        </div>


                        <div class="messages-conversation-info">

                            <div class="messages-conversation-top">

                                <span class="messages-conversation-pseudo">
                                    <?= htmlspecialchars($conversation['pseudo']) ?>
                                </span>

                                <span class="messages-conversation-time">
                                    <?= date(
                                        'H:i',
                                        strtotime($conversation['date_creation'])
                                    ) ?>
                                </span>

                            </div>

                            <div class="messages-conversation-preview">

                                <?= htmlspecialchars(
                                    mb_strimwidth(
                                        $conversation['content'],
                                        0,
                                        35,
                                        '...'
                                    )
                                ) ?>

                            </div>

                        </div>

                    </a>

                <?php endforeach; ?>

            </div>

        </aside>


        <!-- =========================
             PARTIE DROITE
             Conversation ouverte
        ========================== -->
        <div class="messages-main">

            <!-- Utilisateur -->
            <div class="messages-header">

                <div class="messages-header-picture">

                    <?php if ($receiver->getImage()): ?>

                        <img
                            src="<?= htmlspecialchars($receiver->getImage()) ?>"
                            alt="Photo de profil"
                        >

                    <?php else: ?>

                        <div class="messages-header-placeholder">
                            <?= strtoupper(
                                substr($receiver->getPseudo(), 0, 1)
                            ) ?>
                        </div>

                    <?php endif; ?>

                </div>

                <span>
                    <?= htmlspecialchars($receiver->getPseudo()) ?>
                </span>

            </div>


            <!-- Erreurs -->
            <?php if (!empty($errors)): ?>

                <div class="messages-errors">

                    <?php foreach ($errors as $error): ?>

                        <p>
                            <?= htmlspecialchars($error) ?>
                        </p>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>


            <!-- Messages -->
            <div class="messages-content">

                <?php if (empty($messages)): ?>

                    <p class="messages-empty">
                        Aucun message pour le moment.
                        Envoyez le premier message !
                    </p>

                <?php endif; ?>


                <?php foreach ($messages as $message): ?>

                    <?php
                    $isMine = $message->getIdSender()
                        === (int) $_SESSION['user_id'];
                    ?>

                    <div class="
                        message-row
                        <?= $isMine
                            ? 'message-row-sent'
                            : 'message-row-received'
                        ?>
                    ">

                        <div class="message-meta">

                            <?php if (!$isMine): ?>

                                <div class="message-small-picture">

                                    <?php if ($receiver->getImage()): ?>

                                        <img
                                            src="<?= htmlspecialchars(
                                                $receiver->getImage()
                                            ) ?>"
                                            alt="Photo de profil"
                                        >

                                    <?php else: ?>

                                        <div class="message-small-placeholder">
                                            <?= strtoupper(
                                                substr(
                                                    $receiver->getPseudo(),
                                                    0,
                                                    1
                                                )
                                            ) ?>
                                        </div>

                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>

                            <span>
                                <?= date(
                                    'd/m H:i',
                                    strtotime($message->getDateCreation())
                                ) ?>
                            </span>

                        </div>

                        <div class="message-bubble">

                            <?= nl2br(
                                htmlspecialchars($message->getContent())
                            ) ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>


            <!-- Formulaire -->
            <form
                method="POST"
                action="index.php?action=conversation&id=<?= $receiver->getId() ?>"
                class="messages-form"
            >

                <input
                    type="text"
                    name="content"
                    placeholder="Tapez votre message ici"
                    autocomplete="off"
                >

                <button type="submit">
                    Envoyer
                </button>

            </form>

        </div>

    </div>

</section>
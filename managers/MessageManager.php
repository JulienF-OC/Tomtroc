<?php

class MessageManager extends AbstractEntityManager
{
    /**
     * Récupère tous les messages échangés entre deux utilisateurs.
     */
    public function getMessagesBetweenUsers(
        int $userId,
        int $otherUserId
    ): array {
        $query = $this->db->prepare(
            'SELECT *
             FROM `message`
             WHERE (id_sender = :user_id AND id_receiver = :other_user_id)
                OR (id_sender = :other_user_id AND id_receiver = :user_id)
             ORDER BY date_creation ASC'
        );

        $query->execute([
            'user_id' => $userId,
            'other_user_id' => $otherUserId
        ]);

        $messages = [];

        while ($messageData = $query->fetch()) {
            $messages[] = new Message($messageData);
        }

        return $messages;
    }

    /**
     * Récupère la liste des conversations d'un utilisateur.
     * Une seule ligne est retournée par interlocuteur,
     * avec le dernier message échangé.
     */
    public function getConversationsByUserId(int $userId): array
    {
        $query = $this->db->prepare(
            'SELECT
                m.id,
                m.content,
                m.date_creation,
                u.id AS user_id,
                u.pseudo,
                u.image
             FROM `message` m
             INNER JOIN `user` u
                ON u.id = CASE
                    WHEN m.id_sender = :user_id_1
                        THEN m.id_receiver
                    ELSE m.id_sender
                END
             WHERE
                (m.id_sender = :user_id_2 OR m.id_receiver = :user_id_3)
                AND m.id = (
                    SELECT m2.id
                    FROM `message` m2
                    WHERE
                        (
                            m2.id_sender = :user_id_4
                            AND m2.id_receiver = u.id
                        )
                        OR
                        (
                            m2.id_sender = u.id
                            AND m2.id_receiver = :user_id_5
                        )
                    ORDER BY m2.date_creation DESC, m2.id DESC
                    LIMIT 1
                )
             ORDER BY m.date_creation DESC, m.id DESC'
        );

        $query->execute([
            'user_id_1' => $userId,
            'user_id_2' => $userId,
            'user_id_3' => $userId,
            'user_id_4' => $userId,
            'user_id_5' => $userId
        ]);

        return $query->fetchAll();
    }

    /**
     * Enregistre un nouveau message.
     */
    public function createMessage(
        int $senderId,
        int $receiverId,
        string $content
    ): void {
        $query = $this->db->prepare(
            'INSERT INTO `message` (id_sender, id_receiver, content, date_creation)
             VALUES (:sender_id, :receiver_id, :content, NOW())'
        );

        $query->execute([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'content' => $content
        ]);
    }
}
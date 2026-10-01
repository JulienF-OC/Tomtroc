<?php

class Message
{
    private int $id;
    private int $idSender;
    private int $idReceiver;
    private string $content;
    private string $dateCreation;

    public function __construct(array $data)
    {
        $this->id = (int) $data['id'];
        $this->idSender = (int) $data['id_sender'];
        $this->idReceiver = (int) $data['id_receiver'];
        $this->content = $data['content'];
        $this->dateCreation = $data['date_creation'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdSender(): int
    {
        return $this->idSender;
    }

    public function getIdReceiver(): int
    {
        return $this->idReceiver;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getDateCreation(): string
    {
        return $this->dateCreation;
    }
}
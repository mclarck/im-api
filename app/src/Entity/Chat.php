<?php

namespace App\Entity;


class Chat extends Entity
{
 
    protected $sender;
    protected $dest;
    protected $room;
    protected $content;
    protected $isSender;

    public function __construct()
    {
        $this->sender = [];
        $this->dest = [];
    }

    public function getSender(): ?array
    {
        return $this->sender;
    }

    public function setSender(?array $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getDest(): ?array
    {
        return $this->dest;
    }

    public function setDest(?array $dest): self
    {
        $this->dest = $dest;

        return $this;
    }

    public function getRoom(): ?string
    {
        return $this->room;
    }

    public function setRoom(?string $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getIsSender(): ?bool
    {
        return $this->isSender;
    }

    public function setIsSender(?bool $isSender): self
    {
        $this->isSender = $isSender;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }
}

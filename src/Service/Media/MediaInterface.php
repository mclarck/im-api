<?php


namespace App\Service\Media;

interface MediaInterface
{
    public function getName();
    public function setName(string $name): self;
    public function getMime();
    public function setMime(string $name): self;
    public function getType();
    public function setType(string $name): self;
    public function getUri();
    public function setUri(string $name): self;
    public function getPath();
    public function setPath(string $name): self;
}

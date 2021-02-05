<?php

namespace App\Interfaces;

interface IFile
{
    public function getContent();
    public function setContent(string $name);
    public function getSize();
    public function setSize(string $name);
    public function getName();
    public function setName(string $name);
    public function getPath();
    public function setPath(?string $path);
    public function getMime();
    public function setMime(string $mime);
    public function getType();
    public function setType(?string $type);
    public function getExt();
    public function setExt(?string $ext);
    public function getUri();
    public function setUri(?string $ext);
}

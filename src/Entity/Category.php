<?php
namespace App\Entity;

use App\Interfaces\ICategory;

class Category extends Entity implements ICategory
{

    protected $name;

    protected $value;

    public function __construct()
    {
        // ...
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

}

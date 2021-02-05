<?php
namespace App\Entity;

class Location extends Entity
{

    protected $x;

    protected $y;

    protected $label;

    protected $bounds;

    public function __construct()
    {
        // ...
        $this->bounds = [];
    }

    public function getX(): ?float
    {
        return $this->x;
    }

    public function setX(float $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?float
    {
        return $this->y;
    }

    public function setY(float $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getBounds(): ?array
    {
        return $this->bounds;
    }

    public function setBounds(?array $bounds): self
    {
        $this->bounds = $bounds;

        return $this;
    }

}

<?php

namespace App\Entity;

use App\Interfaces\ICategory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Product extends Entity
{


    protected $specie;
    protected $mark;
    protected $variety;
    protected $container;
    protected $details;

    public function __construct()
    {
        // ...
        $this->details = new ArrayCollection();
    }

    /**
     * @return Collection|Category[]
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(Category $detail): self
    {
        if (!$this->details->contains($detail)) {
            $this->details[] = $detail;
        }

        return $this;
    }

    public function removeDetail(Category $detail): self
    {
        $this->details->removeElement($detail);

        return $this;
    }

    public function getSpecie(): ?string
    {
        return $this->specie;
    }

    public function setSpecie(?string $specie): self
    {
        $this->specie = $specie;

        return $this;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(?string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getVariety(): ?string
    {
        return $this->variety;
    }

    public function setVariety(?string $variety): self
    {
        $this->variety = $variety;

        return $this;
    }

    public function getContainer(): ?string
    {
        return $this->container;
    }

    public function setContainer(?string $container): self
    {
        $this->container = $container;

        return $this;
    }
}

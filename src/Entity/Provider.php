<?php
namespace App\Entity;

use App\Interfaces\IMedia;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Provider extends Entity implements IMedia
{

    protected $name;

    protected $alias;

    protected $infos;

    protected $file;

    public function __construct()
    {
        // ...
        $this->infos = new ArrayCollection();
        $this->entries = new ArrayCollection();
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

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getInfos(): Collection
    {
        return $this->infos;
    }

    public function addInfo(Category $info): self
    {
        if (!$this->infos->contains($info)) {
            $this->infos[] = $info;
        }

        return $this;
    }

    public function removeInfo(Category $info): self
    {
        $this->infos->removeElement($info);

        return $this;
    } 
}

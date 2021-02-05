<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Entry extends Entity
{

    protected $stocked;

    protected $sent;

    protected $stocks;

    protected $branch;

    protected $receipt;

    protected $infos;

    protected $provider;

    public function __construct()
    {
        // ...
        $this->stocks = new ArrayCollection();
        $this->infos = new ArrayCollection();
    }

    public function getStocked(): ?\DateTimeInterface
    {
        return $this->stocked;
    }

    public function setStocked(?\DateTimeInterface $stocked): self
    {
        $this->stocked = $stocked;

        return $this;
    }

    public function getSent(): ?\DateTimeInterface
    {
        return $this->sent;
    }

    public function setSent(?\DateTimeInterface $sent): self
    {
        $this->sent = $sent;

        return $this;
    }

    public function getBranch(): ?string
    {
        return $this->branch;
    }

    public function setBranch(?string $branch): self
    {
        $this->branch = $branch;

        return $this;
    }

    public function getReceipt(): ?string
    {
        return $this->receipt;
    }

    public function setReceipt(?string $receipt): self
    {
        $this->receipt = $receipt;

        return $this;
    }

    /**
     * @return Collection|Stock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setEntry($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getEntry() === $this) {
                $stock->setEntry(null);
            }
        }

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

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): self
    {
        $this->provider = $provider;

        return $this;
    }
 

}

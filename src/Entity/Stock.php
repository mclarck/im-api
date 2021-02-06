<?php

namespace App\Entity;

use App\Interfaces\IMedia;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Stock extends Entity implements IMedia
{

    protected $product;

    protected $price;

    protected $cost;

    protected $quantity;

    protected $quantityAv;
    
    protected $oldPrice;

    protected $tax;
    
    protected $shipping;

    protected $shippingAdditional;

    protected $observation;

    protected $infos;

    protected $entry;

    protected $file;

    protected $orders;

    protected $avFromTime;

    protected $avToTime;

    protected $avDays;

    protected $restrictions;

    protected $fraction;
    
    protected $devise;

    protected $discount;

    public function __construct()
    {
        // ...
        $this->infos = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->avDays = [];
        $this->restrictions = [];
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(?float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(?float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

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

    public function getEntry(): ?Entry
    {
        return $this->entry;
    }

    public function setEntry(?Entry $entry): self
    {
        $this->entry = $entry;

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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setStock($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getStock() === $this) {
                $order->setStock(null);
            }
        }

        return $this;
    }

    public function getOldPrice(): ?float
    {
        return $this->oldPrice;
    }

    public function setOldPrice(?float $oldPrice): self
    {
        $this->oldPrice = $oldPrice;

        return $this;
    }

    public function getQuantityAv(): ?float
    {
        return $this->quantityAv;
    }

    public function setQuantityAv(?float $quantityAv): self
    {
        $this->quantityAv = $quantityAv;

        return $this;
    }

    public function getTax(): ?float
    {
        return $this->tax;
    }

    public function setTax(?float $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    public function getShipping(): ?float
    {
        return $this->shipping;
    }

    public function setShipping(?float $shipping): self
    {
        $this->shipping = $shipping;

        return $this;
    }

    public function getShippingAdditional(): ?float
    {
        return $this->shippingAdditional;
    }

    public function setShippingAdditional(?float $shippingAdditional): self
    {
        $this->shippingAdditional = $shippingAdditional;

        return $this;
    }

    public function getAvFromTime(): ?\DateTimeInterface
    {
        return $this->avFromTime;
    }

    public function setAvFromTime(?\DateTimeInterface $avFromTime): self
    {
        $this->avFromTime = $avFromTime;

        return $this;
    }

    public function getAvToTime(): ?\DateTimeInterface
    {
        return $this->avToTime;
    }

    public function setAvToTime(?\DateTimeInterface $avToTime): self
    {
        $this->avToTime = $avToTime;

        return $this;
    }

    public function getAvDays(): ?array
    {
        return $this->avDays;
    }

    public function setAvDays(?array $avDays): self
    {
        $this->avDays = $avDays;

        return $this;
    }

    public function getRestrictions(): ?array
    {
        return $this->restrictions;
    }

    public function setRestrictions(?array $restrictions): self
    {
        $this->restrictions = $restrictions;

        return $this;
    }

    public function getFraction(): ?string
    {
        return $this->fraction;
    }

    public function setFraction(?string $fraction): self
    {
        $this->fraction = $fraction;

        return $this;
    }

    public function getDevise(): ?string
    {
        return $this->devise;
    }

    public function setDevise(?string $devise): self
    {
        $this->devise = $devise;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }
}

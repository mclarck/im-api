<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Setting extends Entity
{

    protected $address;

    protected $openTime;

    protected $closeTime;
    
    protected $openDays;

    protected $bounds;

    protected $emails;

    protected $phones;

    protected $name;
    
    protected $alias;

    protected $title;

    protected $description;

    protected $options;

    protected $country;

    protected $file;
    

    public function __construct()
    {
        // ...
        $this->options = new ArrayCollection();
        $this->openDays = [];
        $this->bounds = [];
        $this->emails = [];
        $this->phones = [];
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Category $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
        }

        return $this;
    }

    public function removeOption(Category $option): self
    {
        $this->options->removeElement($option);

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

    public function getOpenTime(): ?\DateTimeInterface
    {
        return $this->openTime;
    }

    public function setOpenTime(?\DateTimeInterface $openTime): self
    {
        $this->openTime = $openTime;

        return $this;
    }

    public function getCloseTime(): ?\DateTimeInterface
    {
        return $this->closeTime;
    }

    public function setCloseTime(?\DateTimeInterface $closeTime): self
    {
        $this->closeTime = $closeTime;

        return $this;
    }

    public function getOpenDays(): ?array
    {
        return $this->openDays;
    }

    public function setOpenDays(?array $openDays): self
    {
        $this->openDays = $openDays;

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

    public function getEmails(): ?array
    {
        return $this->emails;
    }

    public function setEmails(?array $emails): self
    {
        $this->emails = $emails;

        return $this;
    }

    public function getPhones(): ?array
    {
        return $this->phones;
    }

    public function setPhones(?array $phones): self
    {
        $this->phones = $phones;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
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

}

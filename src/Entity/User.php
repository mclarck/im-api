<?php
namespace App\Entity;

use App\Interfaces\IMedia;
use App\Interfaces\IUser;
use Symfony\Component\Security\Core\User\UserInterface;

class User extends Entity implements UserInterface, IMedia, IUser
{
  
    protected $file;

    protected $username;

    protected $email;

    protected $password;

    protected $roles;
    
    protected $apikey;

    protected $infos;

    public function __construct()
    {
        // ...
        $this->roles = [];
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

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
     * @return string|null
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @return mixed
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getApikey(): ?string
    {
        return $this->apikey;
    }

    public function setApikey(?string $apikey): self
    {
        $this->apikey = $apikey;

        return $this;
    }

    public function getInfos(): ?Category
    {
        return $this->infos;
    }

    public function setInfos(?Category $infos): self
    {
        $this->infos = $infos;

        return $this;
    }
}

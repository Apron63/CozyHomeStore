<?php

declare (strict_types=1);

namespace App\Entity;

use App\Repository\ManagerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ManagerRepository::class)]
class Manager
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $login = null;

    #[ORM\Column(length: 150)]
    private ?string $pswd = null;

    #[ORM\Column(length: 350)]
    private ?string $workers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPswd(): ?string
    {
        return $this->pswd;
    }

    public function setPswd(string $pswd): static
    {
        $this->pswd = $pswd;

        return $this;
    }

    public function getWorkers(): ?string
    {
        return $this->workers;
    }

    public function setWorkers(string $workers): static
    {
        $this->workers = $workers;

        return $this;
    }
}

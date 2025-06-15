<?php

namespace App\Entity;

use App\Enum\CalculatorPeriodEnum;
use App\Repository\ContractRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContractRepository::class)]
class Contract
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $manufacturer = null;

    #[ORM\Column(length: 15)]
    private ?string $loginPharma = null;

    #[ORM\Column(enumType: CalculatorPeriodEnum::class)]
    private ?CalculatorPeriodEnum $period = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getLoginPharma(): ?string
    {
        return $this->loginPharma;
    }

    public function setLoginPharma(string $loginPharma): static
    {
        $this->loginPharma = $loginPharma;

        return $this;
    }

    public function getPeriod(): ?CalculatorPeriodEnum
    {
        return $this->period;
    }

    public function setPeriod(CalculatorPeriodEnum $period): static
    {
        $this->period = $period;

        return $this;
    }
}

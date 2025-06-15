<?php

declare (strict_types=1);

namespace App\Entity;

use App\Enum\CalculatorPeriodEnum;
use App\Repository\GoodsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GoodsRepository::class)]
#[ORM\Index(name: 'manufacturer_idx', columns: ['manufacturer'])]
class Goods
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $manufacturer = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $quarter = null;

    #[ORM\Column(length: 150)]
    private ?string $goods = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 20)]
    private ?string $barcode = null;

    #[ORM\Column(length: 3)]
    private mixed $zvnlp = null;

    #[ORM\Column(length: 100)]
    private ?string $substance = null;

    #[ORM\Column(enumType: CalculatorPeriodEnum::class)]
    private ?CalculatorPeriodEnum $period = null;

    #[ORM\Column(length: 150)]
    private ?string $groupGood = null;

    #[ORM\Column(length: 250)]
    private ?string $fabr = null;

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

    public function getQuarter(): ?int
    {
        return $this->quarter;
    }

    public function setQuarter(int $quarter): static
    {
        $this->quarter = $quarter;

        return $this;
    }

    public function getGoods(): ?string
    {
        return $this->goods;
    }

    public function setGoods(string $goods): static
    {
        $this->goods = $goods;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(string $barcode): static
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getZvnlp(): string
    {
        return $this->zvnlp;
    }

    public function setZvnlp(string $zvnlp): static
    {
        $this->zvnlp = $zvnlp;

        return $this;
    }

    public function getSubstance(): ?string
    {
        return $this->substance;
    }

    public function setSubstance(string $substance): static
    {
        $this->substance = $substance;

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

    public function getGroupGood(): ?string
    {
        return $this->groupGood;
    }

    public function setGroupGood(string $groupGood): static
    {
        $this->groupGood = $groupGood;

        return $this;
    }

    public function getFabr(): ?string
    {
        return $this->fabr;
    }

    public function setFabr(string $fabr): static
    {
        $this->fabr = $fabr;

        return $this;
    }
}

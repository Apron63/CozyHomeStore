<?php

declare (strict_types=1);

namespace App\Entity;

use App\Enum\CalculatorPeriodEnum;
use App\Repository\CalculatorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalculatorRepository::class)]
class Calculator
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: CalculatorPeriodEnum::class, length: 4)]
    private ?CalculatorPeriodEnum $period = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $groupId = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $year = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $quarter = null;

    #[ORM\Column(length: 50)]
    private ?string $manuf = null;

    #[ORM\Column(length: 50)]
    private ?string $pharma = null;

    #[ORM\Column(length: 11)]
    private ?string $pharmaId = null;

    #[ORM\Column(length: 100)]
    private ?string $detal = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $plan = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $fact = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $proc = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $ostDocupit = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $factM1 = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $factM2 = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $factM3 = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $ubas = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $ubasRub = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $boasProc = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $boasRub = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $bmasProc = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $bmasRub = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $bdasProc = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $bdasRub = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $bonusZaPaket = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $tma = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $pushBonus = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $bonusZaOtchet = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $ibas = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $bf = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $bonusKarta = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $oplataTovarom = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $oplataAvansom = null;

    #[ORM\Column(type: Types::FLOAT, scale: 2)]
    private ?float $bonusAsVozm = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    public function setGroupId(int $groupId): static
    {
        $this->groupId = $groupId;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

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

    public function getManuf(): ?string
    {
        return $this->manuf;
    }

    public function setManuf(string $manuf): static
    {
        $this->manuf = $manuf;

        return $this;
    }

    public function getPharma(): ?string
    {
        return $this->pharma;
    }

    public function setPharma(string $pharma): static
    {
        $this->pharma = $pharma;

        return $this;
    }

    public function getPharmaId(): ?string
    {
        return $this->pharmaId;
    }

    public function setPharmaId(string $pharmaId): static
    {
        $this->pharmaId = $pharmaId;

        return $this;
    }

    public function getDetal(): ?string
    {
        return $this->detal;
    }

    public function setDetal(string $detal): static
    {
        $this->detal = $detal;

        return $this;
    }

    public function getPlan(): ?float
    {
        return $this->plan;
    }

    public function setPlan(?float $plan): static
    {
        $this->plan = $plan;

        return $this;
    }

    public function getFact(): ?float
    {
        return $this->fact;
    }

    public function setFact(?float $fact): static
    {
        $this->fact = $fact;

        return $this;
    }

    public function getProc(): ?float
    {
        return $this->proc;
    }

    public function setProc(?float $proc): static
    {
        $this->proc = $proc;

        return $this;
    }

    public function getOstDocupit(): ?float
    {
        return $this->ostDocupit;
    }

    public function setOstDocupit(?float $ostDocupit): static
    {
        $this->ostDocupit = $ostDocupit;

        return $this;
    }

    public function getFactM1(): ?float
    {
        return $this->factM1;
    }

    public function setFactM1(?float $factM1): static
    {
        $this->factM1 = $factM1;

        return $this;
    }

    public function getFactM2(): ?float
    {
        return $this->factM2;
    }

    public function setFactM2(?float $factM2): static
    {
        $this->factM2 = $factM2;

        return $this;
    }

    public function getFactM3(): ?float
    {
        return $this->factM3;
    }

    public function setFactM3(?float $factM3): static
    {
        $this->factM3 = $factM3;

        return $this;
    }

    public function getUbas(): ?float
    {
        return $this->ubas;
    }

    public function setUbas(?float $ubas): static
    {
        $this->ubas = $ubas;

        return $this;
    }

    public function getUbasRub(): ?float
    {
        return $this->ubasRub;
    }

    public function setUbasRub(?float $ubasRub): static
    {
        $this->ubasRub = $ubasRub;

        return $this;
    }

    public function getBoasProc(): ?float
    {
        return $this->boasProc;
    }

    public function setBoasProc(?float $boasProc): static
    {
        $this->boasProc = $boasProc;

        return $this;
    }

    public function getBoasRub(): ?float
    {
        return $this->boasRub;
    }

    public function setBoasRub(?float $boasRub): static
    {
        $this->boasRub = $boasRub;

        return $this;
    }

    public function getBmasProc(): ?float
    {
        return $this->bmasProc;
    }

    public function setBmasProc(?float $bmasProc): static
    {
        $this->bmasProc = $bmasProc;

        return $this;
    }

    public function getBmasRub(): ?float
    {
        return $this->bmasRub;
    }

    public function setBmasRub(?float $bmasRub): static
    {
        $this->bmasRub = $bmasRub;

        return $this;
    }

    public function getBdasProc(): ?float
    {
        return $this->bdasProc;
    }

    public function setBdasProc(?float $bdasProc): static
    {
        $this->bdasProc = $bdasProc;

        return $this;
    }

    public function getBdasRub(): ?float
    {
        return $this->bdasRub;
    }

    public function setBdasRub(?float $bdasRub): static
    {
        $this->bdasRub = $bdasRub;

        return $this;
    }

    public function getBonusZaPaket(): ?float
    {
        return $this->bonusZaPaket;
    }

    public function setBonusZaPaket(?float $bonusZaPaket): static
    {
        $this->bonusZaPaket = $bonusZaPaket;

        return $this;
    }

    public function getTma(): ?float
    {
        return $this->tma;
    }

    public function setTma(?float $tma): static
    {
        $this->tma = $tma;

        return $this;
    }

    public function getPushBonus(): ?float
    {
        return $this->pushBonus;
    }

    public function setPushBonus(?float $pushBonus): static
    {
        $this->pushBonus = $pushBonus;

        return $this;
    }

    public function getBonusZaOtchet(): ?float
    {
        return $this->bonusZaOtchet;
    }

    public function setBonusZaOtchet(?float $bonusZaOtchet): static
    {
        $this->bonusZaOtchet = $bonusZaOtchet;

        return $this;
    }

    public function getIbas(): ?float
    {
        return $this->ibas;
    }

    public function setIbas(?float $ibas): static
    {
        $this->ibas = $ibas;

        return $this;
    }

    public function getBf(): ?float
    {
        return $this->bf;
    }

    public function setBf(?float $bf): static
    {
        $this->bf = $bf;

        return $this;
    }

    public function getBonusKarta(): ?float
    {
        return $this->bonusKarta;
    }

    public function setBonusKarta(?float $bonusKarta): static
    {
        $this->bonusKarta = $bonusKarta;

        return $this;
    }

    public function getOplataTovarom(): ?float
    {
        return $this->oplataTovarom;
    }

    public function setOplataTovarom(?float $oplataTovarom): static
    {
        $this->oplataTovarom = $oplataTovarom;

        return $this;
    }

    public function getOplataAvansom(): ?float
    {
        return $this->oplataAvansom;
    }

    public function setOplataAvansom(?float $oplataAvansom): static
    {
        $this->oplataAvansom = $oplataAvansom;

        return $this;
    }

    public function getBonusAsVozm(): ?float
    {
        return $this->bonusAsVozm;
    }

    public function setBonusAsVozm(?float $bonusAsVozm): static
    {
        $this->bonusAsVozm = $bonusAsVozm;

        return $this;
    }
}

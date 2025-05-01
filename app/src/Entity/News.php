<?php

declare (strict_types=1);

namespace App\Entity;

use App\Enum\NewsTypeEnum;
use App\Repository\NewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $announcement = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date = null;

    #[ORM\Column(length: 255)]
    private ?string $bannerUrl = null;

    #[ORM\Column]
    private ?bool $bannerVis = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?bool $visibility = null;

    #[ORM\Column(enumType: NewsTypeEnum::class, length: 10)]
    private ?NewsTypeEnum $type = null;

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

    public function getAnnouncement(): ?string
    {
        return $this->announcement;
    }

    public function setAnnouncement(string $announcement): static
    {
        $this->announcement = $announcement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getBannerUrl(): ?string
    {
        return $this->bannerUrl;
    }

    public function setBannerUrl(string $bannerUrl): static
    {
        $this->bannerUrl = $bannerUrl;

        return $this;
    }

    public function isBannerVis(): ?bool
    {
        return $this->bannerVis;
    }

    public function setBannerVis(bool $bannerVis): static
    {
        $this->bannerVis = $bannerVis;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function isVisibility(): ?bool
    {
        return $this->visibility;
    }

    public function setVisibility(bool $visibility): static
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function getType(): ?NewsTypeEnum
    {
        return $this->type;
    }

    public function setType(NewsTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }
}

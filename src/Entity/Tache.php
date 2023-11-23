<?php

namespace App\Entity;

use App\Controller\TacheController;
use App\Repository\TacheRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: TacheRepository::class)]
#[ApiResource]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
     private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(
        message: "Veuillez renseigner ce champ "
    )]
    private ?string $description = null;

    #[ORM\Column(length: 10)]
    private ?string $background_color = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]

    private ?\DateTimeInterface $fin = null;

    #[ORM\Column]
    private ?bool $ToutelaJournee = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }


    public function getBackgroundColor(): ?string
    {
        return $this->background_color;
    }

    /**
     * @return bool|null
     */
    public function getToutelaJournee(): ?bool
    {
        return $this->ToutelaJournee;
    }

    public function setBackgroundColor(string $background_color): static
    {
        $this->background_color = $background_color;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): static
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): static
    {
        $this->fin = $fin;

        return $this;
    }

    public function isToutelaJournee(): ?bool
    {
        return $this->ToutelaJournee;
    }

    public function setToutelaJournee(bool $ToutelaJournee): static
    {
        $this->ToutelaJournee = $ToutelaJournee;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }
}

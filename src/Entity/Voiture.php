<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $nb_km = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'voiture', targetEntity: Locateur::class)]
    private Collection $locateurs;

    public function __construct()
    {
        $this->locateurs = new ArrayCollection();
    }

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getNbKm(): ?int
    {
        return $this->nb_km;
    }

    public function setNbKm(int $nb_km): static
    {
        $this->nb_km = $nb_km;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Locateur>
     */
    public function getLocateurs(): Collection
    {
        return $this->locateurs;
    }

    public function addLocateur(Locateur $locateur): static
    {
        if (!$this->locateurs->contains($locateur)) {
            $this->locateurs->add($locateur);
            $locateur->setVoiture($this);
        }

        return $this;
    }

    public function removeLocateur(Locateur $locateur): static
    {
        if ($this->locateurs->removeElement($locateur)) {
            // set the owning side to null (unless already changed)
            if ($locateur->getVoiture() === $this) {
                $locateur->setVoiture(null);
            }
        }

        return $this;
    }
}

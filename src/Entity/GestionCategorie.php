<?php

namespace App\Entity;

use App\Repository\GestionCategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GestionCategorieRepository::class)]
class GestionCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    private $nom_base;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $type_base;

    #[ORM\Column(type: 'datetime')]
    private $date_modification;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'gestionCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private $categorie;

    #[ORM\ManyToOne(targetEntity: Internaute::class, inversedBy: 'gestionCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private $internaute;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomBase(): ?string
    {
        return $this->nom_base;
    }

    public function setNomBase(?string $nom_base): self
    {
        $this->nom_base = $nom_base;

        return $this;
    }

    public function getTypeBase(): ?int
    {
        return $this->type_base;
    }

    public function setTypeBase(?int $type_base): self
    {
        $this->type_base = $type_base;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->date_modification;
    }

    public function setDateModification(\DateTimeInterface $date_modification): self
    {
        $this->date_modification = $date_modification;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getInternaute(): ?Internaute
    {
        return $this->internaute;
    }

    public function setInternaute(?Internaute $internaute): self
    {
        $this->internaute = $internaute;

        return $this;
    }
}

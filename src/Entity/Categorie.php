<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    private $nom;

    #[ORM\Column(type: 'integer')]
    private $type;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Sujet::class)]
    private $sujets;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Recette::class)]
    private $recettes;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: GestionCategorie::class, orphanRemoval: true)]
    private $gestionCategories;

    public function __construct()
    {
        $this->sujets = new ArrayCollection();
        $this->recettes = new ArrayCollection();
        $this->gestionCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Sujet>
     */
    public function getSujets(): Collection
    {
        return $this->sujets;
    }

    public function addSujet(Sujet $sujet): self
    {
        if (!$this->sujets->contains($sujet)) {
            $this->sujets[] = $sujet;
            $sujet->setCategorie($this);
        }

        return $this;
    }

    public function removeSujet(Sujet $sujet): self
    {
        if ($this->sujets->removeElement($sujet)) {
            // set the owning side to null (unless already changed)
            if ($sujet->getCategorie() === $this) {
                $sujet->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes[] = $recette;
            $recette->setCategorie($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recettes->removeElement($recette)) {
            // set the owning side to null (unless already changed)
            if ($recette->getCategorie() === $this) {
                $recette->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GestionCategorie>
     */
    public function getGestionCategories(): Collection
    {
        return $this->gestionCategories;
    }

    public function addGestionCategory(GestionCategorie $gestionCategory): self
    {
        if (!$this->gestionCategories->contains($gestionCategory)) {
            $this->gestionCategories[] = $gestionCategory;
            $gestionCategory->setCategorie($this);
        }

        return $this;
    }

    public function removeGestionCategory(GestionCategorie $gestionCategory): self
    {
        if ($this->gestionCategories->removeElement($gestionCategory)) {
            // set the owning side to null (unless already changed)
            if ($gestionCategory->getCategorie() === $this) {
                $gestionCategory->setCategorie(null);
            }
        }

        return $this;
    }
}

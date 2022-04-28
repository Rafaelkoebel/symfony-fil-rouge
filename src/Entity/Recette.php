<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $titre;

    #[ORM\Column(type: 'integer')]
    private $tempsTotal;

    #[ORM\Column(type: 'integer')]
    private $tempsPreparation;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $tempsCuisson;

    #[ORM\Column(type: 'text')]
    private $instruction;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'integer')]
    private $difficulté;

    #[ORM\Column(type: 'boolean')]
    private $active;

    #[ORM\Column(type: 'datetime')]
    private $date_publication;

    #[ORM\ManyToOne(targetEntity: Internaute::class, inversedBy: 'recettes')]
    #[ORM\JoinColumn(nullable: false)]
    private $internaute;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'recettes')]
    #[ORM\JoinColumn(nullable: false)]
    private $categorie;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: Commentaire::class, orphanRemoval: true)]
    private $commentaires;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: ProduitUtilisé::class)]
    private $produitUtilisés;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: ModerationRecette::class, orphanRemoval: true)]
    private $moderationRecettes;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->produitUtilisés = new ArrayCollection();
        $this->moderationRecettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTempsTotal(): ?int
    {
        return $this->tempsTotal;
    }

    public function setTempsTotal(int $tempsTotal): self
    {
        $this->tempsTotal = $tempsTotal;

        return $this;
    }

    public function getTempsPreparation(): ?int
    {
        return $this->tempsPreparation;
    }

    public function setTempsPreparation(int $tempsPreparation): self
    {
        $this->tempsPreparation = $tempsPreparation;

        return $this;
    }

    public function getTempsCuisson(): ?int
    {
        return $this->tempsCuisson;
    }

    public function setTempsCuisson(int $tempsCuisson): self
    {
        $this->tempsCuisson = $tempsCuisson;

        return $this;
    }

    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    public function setInstruction(string $instruction): self
    {
        $this->instruction = $instruction;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDifficulté(): ?int
    {
        return $this->difficulté;
    }

    public function setDifficulté(int $difficulté): self
    {
        $this->difficulté = $difficulté;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->date_publication;
    }

    public function setDatePublication(\DateTimeInterface $date_publication): self
    {
        $this->date_publication = $date_publication;

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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setRecette($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getRecette() === $this) {
                $commentaire->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProduitUtilisé>
     */
    public function getProduitUtilisés(): Collection
    {
        return $this->produitUtilisés;
    }

    public function addProduitUtilis(ProduitUtilisé $produitUtilis): self
    {
        if (!$this->produitUtilisés->contains($produitUtilis)) {
            $this->produitUtilisés[] = $produitUtilis;
            $produitUtilis->setRecette($this);
        }

        return $this;
    }

    public function removeProduitUtilis(ProduitUtilisé $produitUtilis): self
    {
        if ($this->produitUtilisés->removeElement($produitUtilis)) {
            // set the owning side to null (unless already changed)
            if ($produitUtilis->getRecette() === $this) {
                $produitUtilis->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ModerationRecette>
     */
    public function getModerationRecettes(): Collection
    {
        return $this->moderationRecettes;
    }

    public function addModerationRecette(ModerationRecette $moderationRecette): self
    {
        if (!$this->moderationRecettes->contains($moderationRecette)) {
            $this->moderationRecettes[] = $moderationRecette;
            $moderationRecette->setRecette($this);
        }

        return $this;
    }

    public function removeModerationRecette(ModerationRecette $moderationRecette): self
    {
        if ($this->moderationRecettes->removeElement($moderationRecette)) {
            // set the owning side to null (unless already changed)
            if ($moderationRecette->getRecette() === $this) {
                $moderationRecette->setRecette(null);
            }
        }

        return $this;
    }
}

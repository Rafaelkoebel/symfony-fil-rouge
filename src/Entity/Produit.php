<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Vente::class)]
    private $ventes;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: ProduitUtilisé::class, orphanRemoval: true)]
    private $produitUtilisé;

    public function __construct()
    {
        $this->ventes = new ArrayCollection();
        $this->produitUtilisé = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Vente>
     */
    public function getVentes(): Collection
    {
        return $this->ventes;
    }

    public function addVente(Vente $vente): self
    {
        if (!$this->ventes->contains($vente)) {
            $this->ventes[] = $vente;
            $vente->setProduit($this);
        }

        return $this;
    }

    public function removeVente(Vente $vente): self
    {
        if ($this->ventes->removeElement($vente)) {
            // set the owning side to null (unless already changed)
            if ($vente->getProduit() === $this) {
                $vente->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProduitUtilisé>
     */
    public function getProduitUtilisé(): Collection
    {
        return $this->produitUtilisé;
    }

    public function addProduitUtilis(ProduitUtilisé $produitUtilis): self
    {
        if (!$this->produitUtilisé->contains($produitUtilis)) {
            $this->produitUtilisé[] = $produitUtilis;
            $produitUtilis->setProduit($this);
        }

        return $this;
    }

    public function removeProduitUtilis(ProduitUtilisé $produitUtilis): self
    {
        if ($this->produitUtilisé->removeElement($produitUtilis)) {
            // set the owning side to null (unless already changed)
            if ($produitUtilis->getProduit() === $this) {
                $produitUtilis->setProduit(null);
            }
        }

        return $this;
    }
}

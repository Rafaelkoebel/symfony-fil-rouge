<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VenteRepository::class)]
class Vente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    private $nom_producteur;

    #[ORM\Column(type: 'integer')]
    private $prix;

    #[ORM\Column(type: 'datetime')]
    private $date_vente;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'ventes')]
    #[ORM\JoinColumn(nullable: false)]
    private $produit;

    #[ORM\ManyToOne(targetEntity: Internaute::class, inversedBy: 'ventes')]
    #[ORM\JoinColumn(nullable: false)]
    private $internaute;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProducteur(): ?string
    {
        return $this->nom_producteur;
    }

    public function setNomProducteur(string $nom_producteur): self
    {
        $this->nom_producteur = $nom_producteur;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateVente(): ?\DateTimeInterface
    {
        return $this->date_vente;
    }

    public function setDateVente(\DateTimeInterface $date_vente): self
    {
        $this->date_vente = $date_vente;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

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

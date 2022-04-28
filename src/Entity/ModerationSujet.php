<?php

namespace App\Entity;

use App\Repository\ModerationSujetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModerationSujetRepository::class)]
class ModerationSujet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nom_base;

    #[ORM\Column(type: 'text', nullable: true)]
    private $contenu_base;

    #[ORM\Column(type: 'datetime')]
    private $date_modification;

    #[ORM\ManyToOne(targetEntity: Sujet::class, inversedBy: 'moderationSujets')]
    #[ORM\JoinColumn(nullable: false)]
    private $sujet;

    #[ORM\ManyToOne(targetEntity: Internaute::class, inversedBy: 'moderationSujets')]
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

    public function getContenuBase(): ?string
    {
        return $this->contenu_base;
    }

    public function setContenuBase(?string $contenu_base): self
    {
        $this->contenu_base = $contenu_base;

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

    public function getSujet(): ?Sujet
    {
        return $this->sujet;
    }

    public function setSujet(?Sujet $sujet): self
    {
        $this->sujet = $sujet;

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

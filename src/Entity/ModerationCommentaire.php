<?php

namespace App\Entity;

use App\Repository\ModerationCommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModerationCommentaireRepository::class)]
class ModerationCommentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $contenu_base;

    #[ORM\Column(type: 'datetime')]
    private $date_modification;

    #[ORM\ManyToOne(targetEntity: Commentaire::class, inversedBy: 'moderationCommentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private $commentaire;

    #[ORM\ManyToOne(targetEntity: Internaute::class, inversedBy: 'moderationCommentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private $internaute;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenuBase(): ?string
    {
        return $this->contenu_base;
    }

    public function setContenuBase(string $contenu_base): self
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

    public function getCommentaire(): ?Commentaire
    {
        return $this->commentaire;
    }

    public function setCommentaire(?Commentaire $commentaire): self
    {
        $this->commentaire = $commentaire;

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

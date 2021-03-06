<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $contenu;

    #[ORM\Column(type: 'datetime')]
    private $date_commentaire;

    #[ORM\Column(type: 'integer')]
    private $type;

    #[ORM\ManyToOne(targetEntity: Recette::class, inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private $recette;

    #[ORM\ManyToOne(targetEntity: Internaute::class, inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private $internaute;

    #[ORM\ManyToOne(targetEntity: Sujet::class, inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private $sujet;

    #[ORM\Column(type: 'boolean')]
    private $active;

    #[ORM\OneToMany(mappedBy: 'commentaire', targetEntity: ModerationCommentaire::class, orphanRemoval: true)]
    private $moderationCommentaires;

    public function __construct()
    {
        $this->moderationCommentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateCommentaire(): ?\DateTimeInterface
    {
        return $this->date_commentaire;
    }

    public function setDateCommentaire(\DateTimeInterface $date_commentaire): self
    {
        $this->date_commentaire = $date_commentaire;

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

    public function getRecette(): ?Recette
    {
        return $this->recette;
    }

    public function setRecette(?Recette $recette): self
    {
        $this->recette = $recette;

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

    public function getSujet(): ?Sujet
    {
        return $this->sujet;
    }

    public function setSujet(?Sujet $sujet): self
    {
        $this->sujet = $sujet;

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

    /**
     * @return Collection<int, ModerationCommentaire>
     */
    public function getModerationCommentaires(): Collection
    {
        return $this->moderationCommentaires;
    }

    public function addModerationCommentaire(ModerationCommentaire $moderationCommentaire): self
    {
        if (!$this->moderationCommentaires->contains($moderationCommentaire)) {
            $this->moderationCommentaires[] = $moderationCommentaire;
            $moderationCommentaire->setCommentaire($this);
        }

        return $this;
    }

    public function removeModerationCommentaire(ModerationCommentaire $moderationCommentaire): self
    {
        if ($this->moderationCommentaires->removeElement($moderationCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($moderationCommentaire->getCommentaire() === $this) {
                $moderationCommentaire->setCommentaire(null);
            }
        }

        return $this;
    }
}

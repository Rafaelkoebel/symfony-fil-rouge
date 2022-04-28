<?php

namespace App\Entity;

use App\Repository\ModerationRecetteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModerationRecetteRepository::class)]
class ModerationRecette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $titre_base;

    #[ORM\Column(type: 'text', nullable: true)]
    private $instruction_base;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image_base;

    #[ORM\Column(type: 'datetime')]
    private $date_modification;

    #[ORM\ManyToOne(targetEntity: Recette::class, inversedBy: 'moderationRecettes')]
    #[ORM\JoinColumn(nullable: false)]
    private $recette;

    #[ORM\ManyToOne(targetEntity: Internaute::class, inversedBy: 'moderationRecettes')]
    #[ORM\JoinColumn(nullable: false)]
    private $internaute;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreBase(): ?string
    {
        return $this->titre_base;
    }

    public function setTitreBase(?string $titre_base): self
    {
        $this->titre_base = $titre_base;

        return $this;
    }

    public function getProcedureBase(): ?string
    {
        return $this->instruction_base;
    }

    public function setProcedureBase(?string $procedure_base): self
    {
        $this->instruction_base = $procedure_base;

        return $this;
    }

    public function getImageBase(): ?string
    {
        return $this->image_base;
    }

    public function setImageBase(?string $image_base): self
    {
        $this->image_base = $image_base;

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
}

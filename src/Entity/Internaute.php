<?php

namespace App\Entity;

use App\Repository\InternauteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: InternauteRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Internaute implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'integer')]
    private $type;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresse;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $telephone;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'internaute', targetEntity: Sujet::class, orphanRemoval: true)]
    private $sujets;

    #[ORM\OneToMany(mappedBy: 'internaute', targetEntity: Recette::class)]
    private $recettes;

    #[ORM\OneToMany(mappedBy: 'internaute', targetEntity: Commentaire::class)]
    private $commentaires;

    #[ORM\OneToMany(mappedBy: 'internaute', targetEntity: Vente::class)]
    private $ventes;

    #[ORM\OneToMany(mappedBy: 'internaute', targetEntity: ModerationRecette::class)]
    private $moderationRecettes;

    #[ORM\OneToMany(mappedBy: 'internaute', targetEntity: ModerationCommentaire::class)]
    private $moderationCommentaires;

    #[ORM\OneToMany(mappedBy: 'internaute', targetEntity: ModerationSujet::class)]
    private $moderationSujets;

    #[ORM\OneToMany(mappedBy: 'internaute', targetEntity: GestionCategorie::class)]
    private $gestionCategories;

    public function __construct()
    {
        $this->sujets = new ArrayCollection();
        $this->recettes = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->ventes = new ArrayCollection();
        $this->moderationRecettes = new ArrayCollection();
        $this->moderationCommentaires = new ArrayCollection();
        $this->moderationSujets = new ArrayCollection();
        $this->gestionCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

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
            $sujet->setInternaute($this);
        }

        return $this;
    }

    public function removeSujet(Sujet $sujet): self
    {
        if ($this->sujets->removeElement($sujet)) {
            // set the owning side to null (unless already changed)
            if ($sujet->getInternaute() === $this) {
                $sujet->setInternaute(null);
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
            $recette->setInternaute($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recettes->removeElement($recette)) {
            // set the owning side to null (unless already changed)
            if ($recette->getInternaute() === $this) {
                $recette->setInternaute(null);
            }
        }

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
            $commentaire->setInternaute($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getInternaute() === $this) {
                $commentaire->setInternaute(null);
            }
        }

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
            $vente->setInternaute($this);
        }

        return $this;
    }

    public function removeVente(Vente $vente): self
    {
        if ($this->ventes->removeElement($vente)) {
            // set the owning side to null (unless already changed)
            if ($vente->getInternaute() === $this) {
                $vente->setInternaute(null);
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
            $moderationRecette->setInternaute($this);
        }

        return $this;
    }

    public function removeModerationRecette(ModerationRecette $moderationRecette): self
    {
        if ($this->moderationRecettes->removeElement($moderationRecette)) {
            // set the owning side to null (unless already changed)
            if ($moderationRecette->getInternaute() === $this) {
                $moderationRecette->setInternaute(null);
            }
        }

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
            $moderationCommentaire->setInternaute($this);
        }

        return $this;
    }

    public function removeModerationCommentaire(ModerationCommentaire $moderationCommentaire): self
    {
        if ($this->moderationCommentaires->removeElement($moderationCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($moderationCommentaire->getInternaute() === $this) {
                $moderationCommentaire->setInternaute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ModerationSujet>
     */
    public function getModerationSujets(): Collection
    {
        return $this->moderationSujets;
    }

    public function addModerationSujet(ModerationSujet $moderationSujet): self
    {
        if (!$this->moderationSujets->contains($moderationSujet)) {
            $this->moderationSujets[] = $moderationSujet;
            $moderationSujet->setInternaute($this);
        }

        return $this;
    }

    public function removeModerationSujet(ModerationSujet $moderationSujet): self
    {
        if ($this->moderationSujets->removeElement($moderationSujet)) {
            // set the owning side to null (unless already changed)
            if ($moderationSujet->getInternaute() === $this) {
                $moderationSujet->setInternaute(null);
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
            $gestionCategory->setInternaute($this);
        }

        return $this;
    }

    public function removeGestionCategory(GestionCategorie $gestionCategory): self
    {
        if ($this->gestionCategories->removeElement($gestionCategory)) {
            // set the owning side to null (unless already changed)
            if ($gestionCategory->getInternaute() === $this) {
                $gestionCategory->setInternaute(null);
            }
        }

        return $this;
    }

}

<?php

namespace App\Entity;

use App\Repository\MotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotoRepository::class)]
class Moto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: '0')]
    private ?string $annee = null;

    #[ORM\ManyToOne(inversedBy: 'motos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ListColor $couleur = null;

    #[ORM\ManyToOne(inversedBy: 'motos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ListCylinder $cylindre = null;

    #[ORM\ManyToOne(inversedBy: 'motos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ListBrand $marque = null;

    #[ORM\OneToMany(mappedBy: 'moto', targetEntity: Comments::class)]
    private Collection $comments;

    #[ORM\ManyToOne(inversedBy: 'motos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ListType $type = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getCouleur(): ?ListColor
    {
        return $this->couleur;
    }

    public function setCouleur(?ListColor $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getCylindre(): ?ListCylinder
    {
        return $this->cylindre;
    }

    public function setCylindre(?ListCylinder $cylindre): self
    {
        $this->cylindre = $cylindre;

        return $this;
    }

    public function getMarque(): ?ListBrand
    {
        return $this->marque;
    }

    public function setMarque(?ListBrand $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setMoto($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getMoto() === $this) {
                $comment->setMoto(null);
            }
        }

        return $this;
    }

    public function getType(): ?ListType
    {
        return $this->type;
    }

    public function setType(?ListType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\MotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: MotoRepository::class)]
#[Vich\Uploadable]
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

    #[ORM\ManyToOne(inversedBy: 'motos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ListType $type = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: 'moto', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 8192)]
    private ?string $article = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedDate = null;

    public function __construct()
    {
        
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

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedDate = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(string $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getUpdatedDate(): ?\DateTimeInterface
    {
        return $this->updatedDate;
    }

    public function setUpdatedDate(\DateTimeInterface $updatedDate): self
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }
}

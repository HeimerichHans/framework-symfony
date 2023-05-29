<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?user $auteur = null;

    #[ORM\Column(length: 4096)]
    private ?string $texte = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;
   
    #[ORM\JoinColumn(nullable: false)]
    private ?moto $moto = null;

    #[ORM\ManyToOne(inversedBy: 'moto')]

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?user
    {
        return $this->auteur;
    }

    public function setAuteur(?user $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMoto(): ?moto
    {
        return $this->moto;
    }

    public function setMoto(?moto $moto): self
    {
        $this->moto = $moto;

        return $this;
    }
}

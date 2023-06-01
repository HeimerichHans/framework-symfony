<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 4096)]
    private ?string $texte = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'commentairesMoto')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Moto $motoComments = null;

    #[ORM\ManyToOne(inversedBy: 'commentairesUser')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userComments = null;

    public function __construct()
    {
        $this->date = new DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function __toString(): string
    {
        return $this->texte;
    }

    public function getMotoComments(): ?Moto
    {
        return $this->motoComments;
    }

    public function setMotoComments(?Moto $motoComments): self
    {
        $this->motoComments = $motoComments;

        return $this;
    }

    public function getUserComments(): ?User
    {
        return $this->userComments;
    }

    public function setUserComments(?User $userComments): self
    {
        $this->userComments = $userComments;

        return $this;
    }
}

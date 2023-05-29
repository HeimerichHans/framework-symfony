<?php

namespace App\Entity;

use App\Repository\ListBrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListBrandRepository::class)]
class ListBrand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\OneToMany(mappedBy: 'marque', targetEntity: Moto::class)]
    private Collection $motos;

    public function __construct()
    {
        $this->motos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection<int, Moto>
     */
    public function getMotos(): Collection
    {
        return $this->motos;
    }

    public function addMoto(Moto $moto): self
    {
        if (!$this->motos->contains($moto)) {
            $this->motos->add($moto);
            $moto->setMarque($this);
        }

        return $this;
    }

    public function removeMoto(Moto $moto): self
    {
        if ($this->motos->removeElement($moto)) {
            // set the owning side to null (unless already changed)
            if ($moto->getMarque() === $this) {
                $moto->setMarque(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getMarque();
    }
}

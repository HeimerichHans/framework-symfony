<?php

namespace App\Entity;

use App\Repository\ListCylinderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListCylinderRepository::class)]
class ListCylinder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $cylindre = null;

    #[ORM\OneToMany(mappedBy: 'cylindre', targetEntity: Moto::class)]
    private Collection $motos;

    public function __construct()
    {
        $this->motos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCylindre(): ?string
    {
        return $this->cylindre;
    }

    public function setCylindre(string $cylindre): self
    {
        $this->cylindre = $cylindre;

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
            $moto->setCylindre($this);
        }

        return $this;
    }

    public function removeMoto(Moto $moto): self
    {
        if ($this->motos->removeElement($moto)) {
            // set the owning side to null (unless already changed)
            if ($moto->getCylindre() === $this) {
                $moto->setCylindre(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getCylindre();
    }
}

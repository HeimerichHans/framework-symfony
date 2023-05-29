<?php

namespace App\Entity;

use App\Repository\ListTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListTypeRepository::class)]
class ListType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Moto::class)]
    private Collection $motos;

    public function __construct()
    {
        $this->motos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
            $moto->setType($this);
        }

        return $this;
    }

    public function removeMoto(Moto $moto): self
    {
        if ($this->motos->removeElement($moto)) {
            // set the owning side to null (unless already changed)
            if ($moto->getType() === $this) {
                $moto->setType(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getType();
    }
}

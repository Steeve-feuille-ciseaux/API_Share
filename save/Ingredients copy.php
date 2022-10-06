<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: IngredientsRepository::class)]
#[ApiResource]
class Ingredients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Cocktails::class, inversedBy: 'ingredients')]
    private Collection $ajout;

    public function __construct()
    {
        $this->ajout = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Cocktails>
     */
    public function getAjout(): Collection
    {
        return $this->ajout;
    }

    public function addAjout(Cocktails $ajout): self
    {
        if (!$this->ajout->contains($ajout)) {
            $this->ajout->add($ajout);
        }

        return $this;
    }

    public function removeAjout(Cocktails $ajout): self
    {
        $this->ajout->removeElement($ajout);

        return $this;
    }
}

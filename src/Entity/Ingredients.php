<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext:["groups" => ["ingredients:read"]],
)]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'exact',])]
#[ORM\Entity(repositoryClass: IngredientsRepository::class)]
class Ingredients
{
    #[Groups(["ingredients:read"])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(["ingredients:read"])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Cocktails::class, inversedBy: 'ingredients')]
    private Collection $cocktails;

    public function __construct()
    {
        $this->cocktails = new ArrayCollection();
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
    public function getCocktails(): Collection
    {
        return $this->cocktails;
    }

    public function addCocktails(Cocktails $cocktails): self
    {
        if (!$this->cocktails->contains($cocktails)) {
            $this->cocktails->add($cocktails);
        }

        return $this;
    }

    public function removeCocktails(Cocktails $cocktails): self
    {
        $this->cocktails->removeElement($cocktails);

        return $this;
    }
}

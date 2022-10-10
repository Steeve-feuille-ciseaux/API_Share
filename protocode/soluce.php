<?php

namespace App\Entity;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\CollectionOperationInterface;

#[ORM\Entity(repositoryClass: IngredientsRepository::class)]
// SOLUCE DEBUT
#[ApiResource(routePrefix: '/cocktails')]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/cocktails/ingredients/{id}',),
    ]
)]
// SOLUCE FIN
#[ApiFilter(SearchFilter::class, properties: ['name' => 'partial'])]
class Ingredients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column(length: 255)]
    #[Groups(['read:collection'])]
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

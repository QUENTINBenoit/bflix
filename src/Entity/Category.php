<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Stringable;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category implements Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('groupsCategories')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message: 'Merci de saisir le nom de la catégorie')]
    #[Groups('groupsCategories')]
    private $name;


    #[ORM\ManyToMany(targetEntity: Tvshow::class, mappedBy: 'catgoriess')]
    private $tvshows;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->tvshows = new ArrayCollection();
    }
    public function __toString(): string
    {
        return  $this->name;
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

    public function addCategory(Tvshow $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Tvshow $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection|Tvshow[]
     */
    public function getTvshows(): Collection
    {
        return $this->tvshows;
    }

    public function addTvshow(Tvshow $tvshow): self
    {
        if (!$this->tvshows->contains($tvshow)) {
            $this->tvshows[] = $tvshow;
        }

        return $this;
    }

    public function removeTvshow(Tvshow $tvshow): self
    {
        $this->tvshows->removeElement($tvshow);

        return $this;
    }
}

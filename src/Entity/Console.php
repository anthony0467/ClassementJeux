<?php

namespace App\Entity;

use App\Repository\ConsoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsoleRepository::class)]
class Console
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Jeu::class, inversedBy: 'consoles')]
    private Collection $jeu;

    public function __construct()
    {
        $this->jeu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Jeu>
     */
    public function getJeu(): Collection
    {
        return $this->jeu;
    }

    public function addJeu(Jeu $jeu): static
    {
        if (!$this->jeu->contains($jeu)) {
            $this->jeu->add($jeu);
        }

        return $this;
    }

    public function removeJeu(Jeu $jeu): static
    {
        $this->jeu->removeElement($jeu);

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}

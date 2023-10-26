<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]//creation de Classe :est une entité;koll entité aandha her own repository //
class Author
{
    #[ORM\Id]//cle primaire//
    #[ORM\GeneratedValue]//auto-increment dans DB;ma yest7a9ech Setter nd getter//
    #[ORM\Column]//creer une colomne//
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $username = null;

    #[ORM\Column(length: 30)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?int $nb_class = null;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Book::class)]
    private Collection $boooks;

    public function __construct()
    {
        $this->boooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNbClass(): ?int
    {
        return $this->nb_class;
    }

    public function setNbClass(?int $nb_class): static
    {
        $this->nb_class = $nb_class;

        return $this;
    }

/**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->boooks;
    }

    public function addBook(Book $book): static
    {
        if (!$this->boooks->contains($book)) {
            $this->boooks->add($book);
            $book->setauthor($this);
        }

        return $this;
    }

    public function removeBook(Book $book): static
    {
        if ($this->boooks->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getauthor() === $this) {
                $book->setauthor(null);
            }
        }

        return $this;
    }
}
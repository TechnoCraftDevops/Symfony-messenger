<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToMany(targetEntity: NewsLetter::class, mappedBy: 'Users')]
    private Collection $newsLetters;

    public function __construct()
    {
        $this->newsLetters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

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

    /**
     * @return Collection<int, NewsLetter>
     */
    public function getNewsLetters(): Collection
    {
        return $this->newsLetters;
    }

    public function addNewsLetter(NewsLetter $newsLetter): static
    {
        if (!$this->newsLetters->contains($newsLetter)) {
            $this->newsLetters->add($newsLetter);
            $newsLetter->addUser($this);
        }

        return $this;
    }

    public function removeNewsLetter(NewsLetter $newsLetter): static
    {
        if ($this->newsLetters->removeElement($newsLetter)) {
            $newsLetter->removeUser($this);
        }

        return $this;
    }
}

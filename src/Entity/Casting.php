<?php

namespace App\Entity;

use App\Repository\CastingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=CastingRepository::class)
 */
class Casting
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     *  @Groups({"api_v1_movie_show"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     *  @Groups({"api_v1_movie_show"})
     */
    private $role;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     *  @Groups({"api_v1_movie_show"})
     */
    private $creditOrder;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="castings")
     * 
     *  @Groups({"api_v1_movie_show"})
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity=Movie::class, inversedBy="castings")
     * 
     */
    private $movie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getCreditOrder(): ?int
    {
        return $this->creditOrder;
    }

    public function setCreditOrder(?int $creditOrder): self
    {
        $this->creditOrder = $creditOrder;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }
}

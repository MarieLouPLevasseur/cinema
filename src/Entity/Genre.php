<?php 

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\GenreRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity(repositoryClass=GenreRepository::class)
 */
class Genre {

    /**
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     * @Groups({"api_v1_movie_list"})
     * @Groups({"api_v1_movie_show"})
     * 
     * @Groups({"api_v1_genre_list"})
     * @Groups({"api_v1_genre_show"})
     * 
     * @var int
     */
    private $id;

    /**
     *
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotNull
     * @Assert\Length(
     *      min=2
     * )
     * 
     * @Groups({"api_v1_movie_list"})
     * @Groups({"api_v1_movie_show"})
     * 
     * @Groups({"api_v1_genre_show"})
     * @Groups({"api_v1_genre_list"})
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Movie::class, mappedBy="genres")
     * 
     * 
     * @Groups({"api_v1_genre_list"})
     * @Groups({"api_v1_genre_show"})
     * 
     */
    private $movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    // ! converti en string pour avoir l'ajout movie
    public function __toString()
    {
        return $this->name;
    }
    
    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName():string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies[] = $movie;
        }

        return $this;
    }

    public function removeMovie(Movie $movie): self
    {
        $this->movies->removeElement($movie);

        return $this;
    }

}
<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"api_v1_movie_list"})
     * @Groups({"api_v1_movie_show"})
     * 
     * @Groups({"api_v1_genre_list"})
     * @Groups({"api_v1_genre_list_movies"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     * 
     * @Groups({"api_v1_movie_list"})
     * @Groups({"api_v1_movie_show"})
     * @Groups({"api_v1_genre_list_movies"})
     */
    private $isan;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"api_v1_movie_list"})
     * @Groups({"api_v1_movie_show"})
     * 
     * @Groups({"api_v1_genre_list"})
     * @Groups({"api_v1_genre_list_movies"})
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups({"api_v1_movie_list"})
     * @Groups({"api_v1_movie_show"})
     * @Groups({"api_v1_genre_list_movies"})
     */
    private $duration;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * 
     * @Groups({"api_v1_movie_list" })
     * @Groups({"api_v1_movie_show"})
     * @Groups({"api_v1_genre_list_movies"})
     */
    private $releasedAt;

    /**
     * @ORM\Column(type="text")
     * 
     * @Groups({"api_v1_movie_show"})
     */
    private $summary;

    /**
     * @ORM\Column(type="text")
     * 
     * @Groups({"api_v1_movie_show"})
     */
    private $synopsis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"api_v1_movie_list"})
     * @Groups({"api_v1_movie_show"})
     */
    private $poster;

    /**
     * @ORM\Column(type="float", nullable=true)
     * 
     * @Groups({"api_v1_movie_show"})
     * @Groups({"api_v1_genre_list_movies"})
     */
    private $rating;

    /**
     * @ORM\OneToMany(targetEntity=Season::class, mappedBy="movie", orphanRemoval=true)
     * 
     * @Groups({"api_v1_movie_show"})
     */
    private $seasons;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="movies")
     * @Groups({"api_v1_movie_list"})
     * @Groups({"api_v1_movie_show"})
     */
    private $genres;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="movie", orphanRemoval=true)
     * 
     */
    private $reviews;

    /**
     * @ORM\OneToMany(targetEntity=Casting::class, mappedBy="movie", orphanRemoval=true)
     * 
     * @Groups({"api_v1_movie_show"})
     */
    private $castings;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"api_v1_movie_show"})
     */
    private $slug;

    public function __construct()
    {
        $this->seasons = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->castings = new ArrayCollection();
    }

// ! converti en string pour avoir l'ajout review et Casting
    public function __toString()
    {
        return $this->title . '(' . $this->getType() . ')';
    }

    /**
     * cette m??thode sert ?? Twig pour pouvoir afficher une valeur lorsque l'on fait un show.type
     *
     * @return string
     */
    public function getType() :string
    {
         // ? si il y a des saisons associ??es alors c'est une S??rie
         if (count($this->getSeasons()) > 0) {
             return 'S??rie';
         }
        //  sinon c'est un film
        return 'Film';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsan(): ?string
    {
        return $this->isan;
    }

    public function setIsan(?string $isan): self
    {
        $this->isan = $isan;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getReleasedAt(): ?\DateTimeImmutable
    {
        return $this->releasedAt;
    }

    public function setReleasedAt(?\DateTimeImmutable $releasedAt): self
    {
        $this->releasedAt = $releasedAt;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return Collection<int, Season>
     */
    public function getSeasons(): Collection
    {
        return $this->seasons;
    }

    public function addSeason(Season $season): self
    {
        // le maker nous aide ?? remplir le cot?? propri??taire.
        if (!$this->seasons->contains($season)) {
            $this->seasons[] = $season;
            $season->setMovie($this);
        }

        return $this;
    }

    public function removeSeason(Season $season): self
    {
        if ($this->seasons->removeElement($season)) {
            // set the owning side to null (unless already changed)
            if ($season->getMovie() === $this) {
                $season->setMovie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
            $genre->addMovie($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeMovie($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setMovie($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getMovie() === $this) {
                $review->setMovie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Casting>
     */
    public function getCastings(): Collection
    {
        return $this->castings;
    }

    public function addCasting(Casting $casting): self
    {
        if (!$this->castings->contains($casting)) {
            $this->castings[] = $casting;
            $casting->setMovie($this);
        }

        return $this;
    }

    public function removeCasting(Casting $casting): self
    {
        if ($this->castings->removeElement($casting)) {
            // set the owning side to null (unless already changed)
            if ($casting->getMovie() === $this) {
                $casting->setMovie(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }


}
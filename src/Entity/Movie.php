<?php
declare(strict_types = 1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class Movie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * See MovieFormat::
     *
     * @ORM\Column(type="string", length=10)
     */
    private $format;

    /**
     * @ORM\Column(type="integer")
     */
    private $length;

    /**
     * @ORM\Column(type="integer")
     */
    private $releaseYear;

    /**
     * @ORM\Column(type="integer")
     */
    private $rating;

    /**
     * Get identifier
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Movie
     */
    public function setTitle(string $title): Movie
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get format
     *
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Set format
     *
     * @param string $format
     *
     * @return Movie
     */
    public function setFormat(string $format): Movie
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get length
     *
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * Set length
     *
     * @param int $length
     *
     * @return Movie
     */
    public function setLength(int $length): Movie
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get release year
     *
     * @return int
     */
    public function getReleaseYear(): int
    {
        return $this->releaseYear;
    }

    /**
     * Set release year
     *
     * @param int $releaseYear
     *
     * @return Movie
     */
    public function setReleaseYear(int $releaseYear): Movie
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    /**
     * Get rating
     *
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * Set rating
     *
     * @param int $rating
     *
     * @return Movie
     */
    public function setRating(int $rating): Movie
    {
        $this->rating = $rating;

        return $this;
    }
}

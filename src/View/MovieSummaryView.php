<?php
declare(strict_types = 1);

namespace App\View;

use App\Entity\Movie;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class MovieSummaryView
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
final class MovieSummaryView
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotNull
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 50)
     *
     * @Serializer\Type("string")
     */
    private $title;

    /**
     * @var string
     *
     * @Assert\NotNull
     * @Assert\NotBlank()
     * @Assert\Choice({"VHS", "DVD", "Streaming"})
     *
     * @Serializer\Type("string")
     */
    private $format;

    /**
     * @var int
     *
     * @Assert\NotNull
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(0)
     * @Assert\LessThanOrEqual(500)
     *
     * @Serializer\Type("int")
     */
    private $length;

    /**
     * @var int
     *
     * @Assert\NotNull
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(1800)
     * @Assert\LessThanOrEqual(2100)
     *
     * @Serializer\Type("int")
     */
    private $releaseYear;

    /**
     * @var int
     *
     * @Assert\NotNull
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(1)
     * @Assert\LessThanOrEqual(5)
     *
     * @Serializer\Type("int")
     */
    private $rating;

    /**
     * MovieSummaryView constructor.
     *
     * @param Movie $movie
     */
    public function __construct(Movie $movie)
    {
        $this->id = $movie->getId();
        $this->title = $movie->getTitle();
        $this->format = $movie->getFormat();
        $this->length = $movie->getLength();
        $this->releaseYear = $movie->getReleaseYear();
        $this->rating = $movie->getRating();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return int
     */
    public function getReleaseYear(): int
    {
        return $this->releaseYear;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }
}
<?php
declare(strict_types = 1);

namespace App\View;

use App\Entity\Movie;
use JMS\Serializer\Annotation as Serializer;

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
     * @Serializer\Type("string")
     */
    private $title;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $format;

    /**
     * @var int
     * @Serializer\Type("int")
     */
    private $length;

    /**
     * @var int
     * @Serializer\Type("int")
     */
    private $releaseYear;

    /**
     * @var int
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
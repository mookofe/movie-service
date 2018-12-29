<?php
declare(strict_types = 1);

namespace App\View;

use App\Entity\Movie;

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
     */
    private $title;

    /**
     * @var string
     */
    private $format;

    /**
     * @var int
     */
    private $length;

    /**
     * @var int
     */
    private $releaseYear;

    /**
     * @var int
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
}
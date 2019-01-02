<?php
declare(strict_types = 1);

namespace App\View;

use App\Entity\Movie;
use JMS\Serializer\Annotation as Serializer;
use App\Integration\MetadataService\DTO\MovieMetadata;

/**
 * Class MovieView
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MovieView
{
    /**
     * @var Movie
     *
     * @Serializer\Exclude()
     */
    private $movie;

    /**
     * @var MovieMetadata
     */
    private $metadata;

    /**
     * MovieView constructor.
     * @param Movie $movie
     * @param MovieMetadata $metadata
     */
    public function __construct(Movie $movie, ?MovieMetadata $metadata)
    {
        $this->movie = $movie;
        $this->metadata = $metadata;
    }

    /**
     * @return int
     *
     * @Serializer\VirtualProperty()
     */
    public function getId(): int
    {
        return $this->movie->getId();
    }

    /**
     * @return string
     *
     * @Serializer\VirtualProperty()
     */
    public function getTitle(): string
    {
        return $this->movie->getTitle();
    }

    /**
     * @return string
     *
     * @Serializer\VirtualProperty()
     */
    public function getFormat(): string
    {
        return $this->movie->getFormat();
    }

    /**
     * @return int
     *
     * @Serializer\VirtualProperty()
     */
    public function getLength(): int
    {
        return $this->movie->getLength();
    }

    /**
     * @return int
     *
     * @Serializer\VirtualProperty()
     */
    public function getReleaseYear(): int
    {
        return $this->movie->getReleaseYear();
    }

    /**
     * @return int
     *
     * @Serializer\VirtualProperty()
     */
    public function getRating(): int
    {
        return $this->movie->getRating();
    }
}
<?php
declare(strict_types = 1);

namespace App\View;

use App\Entity\Movie;
use Doctrine\Common\Collections\Collection;

/**
 * Class MovieSummaryCollectionView
 *
 * @package App\View
 */
final class MovieSummaryCollectionView
{
    /**
     * @var MovieSummaryView[]
     */
    private $data = [];

    /**
     * @var
     */
    private $meta;

    /**
     * MovieCollectionView constructor.
     *
     * @param Collection $movies
     * @param int        $skipped
     * @param int        $totalRows
     */
    public function __construct(Collection $movies, int $skipped, int $totalRows)
    {
        $this->transformCollection($movies);
        $this->meta = new ResponseMetadataView($skipped, $totalRows);
    }

    /**
     * Transform collection of Movies to list of MovieSummaryView
     *
     * @param Collection $movies
     */
    private function transformCollection(Collection $movies): void
    {
        /** @var Movie $movie */
        foreach ($movies as $movie){
            $this->data[] = new MovieSummaryView($movie);
        }
    }
}
<?php
declare(strict_types = 1);

namespace App\Service;

use App\Entity\Movie;
use App\Entity\MovieQuery;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Collection;
use App\Exception\MovieAlreadyExistException;

/**
 * Service to handle Movie operations
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MovieService
{
    /**
     * @var MovieRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * MovieService constructor.
     * @param MovieRepository $repository
     * @param EntityManagerInterface $manager
     */
    public function __construct(MovieRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * Find all movies
     *
     * @param MovieQuery $query
     * @return Collection
     */
    public function findAll(MovieQuery $query): Collection
    {
        $criteria = $this->buildCriteriaFromQuery($query);

        return $this->repository->matching($criteria);
    }

    /**
     * Save movie
     *
     * @param Movie $movie
     * @return Movie
     */
    public function save(Movie $movie): Movie
    {
        $this->validateTitleIsUnique($movie);

        $this->manager->persist($movie);
        $this->manager->flush();

        return $movie;
    }

    /**
     * Delete movie
     *
     * @param Movie $movie
     */
    public function delete(Movie $movie): void
    {
        $this->manager->remove($movie);

        $this->manager->flush();
    }

    /**
     * Get count of total movies in the system
     *
     * @return int
     */
    public function getTotalMoviesCount(): int
    {
        return $this->repository->count([]);
    }

    /**
     * Build doctrine criteria from query
     *
     * @param MovieQuery $query
     * @return Criteria
     */
    private function buildCriteriaFromQuery(MovieQuery $query): Criteria
    {
        $criteria = Criteria::create();

        if ($query->getOrderBy() !== null){
            $column = $query->getOrderBy();
            $orientation = $query->getOrientation() !== null
                ? $query->getOrientation()
                : MovieQuery::ORIENTATION_ASC;

            $criteria->orderBy([$column => $orientation]);
        }

        $criteria->setFirstResult($query->getSkip());
        $criteria->setMaxResults($query->getLimit());

        return $criteria;
    }

    /**
     * Check if there's another movie with the same title and year
     *
     * @param Movie $movie
     */
    private function validateTitleIsUnique(Movie $movie)
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('title', $movie->getTitle()))
            ->andWhere(Criteria::expr()->eq('releaseYear', $movie->getReleaseYear()));

        //Skip current one
        if ($this->manager->contains($movie)){
            $criteria->andWhere(Criteria::expr()->neq('id', $movie->getId()));
        }

        $foundMovie = $this->repository->matching($criteria)
            ->first();

        if ($foundMovie !== false){
            throw new MovieAlreadyExistException($movie);
        }
    }
}
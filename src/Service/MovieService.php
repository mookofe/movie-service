<?php
declare(strict_types = 1);

namespace App\Service;

use App\Entity\MovieQuery;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Collection;

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
}
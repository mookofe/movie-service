<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Entity\MovieQuery;
use App\Service\MovieService;
use FOS\RestBundle\View\View;
use App\View\MovieSummaryCollectionView;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class MovieController
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MovieController extends FOSRestController
{
    /**
     * @var MovieService
     */
    private $movieService;

    /**
     * MovieController constructor.
     *
     * @param MovieService $movieService
     */
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * Show list of movies
     *
     * @param Request $request
     * @Rest\Get("/movies")
     * @return View
     */
    public function index(Request $request): View
    {
        $query = $this->getQueryFromRequest($request);
        $movies = $this->movieService->findAll($query);

        $movieSummaryCollection = new MovieSummaryCollectionView(
            $movies,
            (int)$request->get('skip', 0),
            $this->movieService->getTotalMoviesCount()
        );

        return new View($movieSummaryCollection);
    }

    /**
     * Get movie query from request
     *
     * @param Request $request
     * @return MovieQuery
     */
    private function getQueryFromRequest(Request $request): MovieQuery
    {
        $orderBy = $request->get('orderBy');
        $orientation = $request->get('orientation');
        $skip = (int)$request->get('skip',0);
        $limit = (int)$request->get('limit', 20);

        return new MovieQuery(
            $orderBy,
            $orientation,
            $skip,
            $limit
        );
    }
}
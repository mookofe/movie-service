<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Entity\Movie;
use App\View\MovieView;
use App\Entity\MovieQuery;
use FOS\RestBundle\View\View;
use App\Service\MovieService;
use App\View\MovieSummaryView;
use App\Service\MovieMetadataFetcher;
use App\View\MovieSummaryCollectionView;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\Exception\ValidationFailedException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @var MovieMetadataFetcher
     */
    private $metadataService;

    /**
     * MovieController constructor.
     *
     * @param MovieService         $movieService
     * @param MovieMetadataFetcher $metadataService
     */
    public function __construct(MovieService $movieService, MovieMetadataFetcher $metadataService)
    {
        $this->movieService    = $movieService;
        $this->metadataService = $metadataService;
    }

    /**
     * Show list of movies
     *
     * @Rest\Get("/movies")
     *
     * @param Request $request
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
     * @Rest\Get("/movies/{id}")
     *
     * @param Movie $movie
     * @return View
     */
    public function show(Movie $movie): View
    {
        return $this->buildMovieView($movie);
    }

    /**
     * @Rest\Post("/movies")
     *
     * @ParamConverter("movieDTO", converter="fos_rest.request_body")
     *
     * @param MovieSummaryView                  $movieDTO
     * @param ConstraintViolationListInterface  $validationErrors
     * @return View
     */
    public function store(MovieSummaryView $movieDTO, ConstraintViolationListInterface $validationErrors): View
    {
        if ($validationErrors->count() > 0){
            return View::create($validationErrors);
        }

        $movie = new Movie();
        $this->mapToMovie($movieDTO, $movie);
        $this->movieService->save($movie);

        return $this->buildMovieView($movie);
    }

    /**
     * @Rest\Put("/movies/{id}")
     *
     * @ParamConverter("movieDTO", converter="fos_rest.request_body")
     *
     * @param MovieSummaryView                 $movieDTO
     * @param ConstraintViolationListInterface $validationErrors
     * @param Movie                            $movie
     * @return View
     */
    public function update(MovieSummaryView $movieDTO, ConstraintViolationListInterface $validationErrors, Movie $movie): View
    {
        if ($validationErrors->count() > 0){
            return View::create($validationErrors);
        }

        $this->mapToMovie($movieDTO, $movie);
        $this->movieService->save($movie);

        return $this->buildMovieView($movie);
    }

    /**
     * @Rest\Delete("/movies/{id}")
     *
     * @param Movie $movie
     * @return View
     */
    public function delete(Movie $movie): View
    {
        $this->movieService->delete($movie);

        return new View();
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

    /**
     * Map MovieDTO to Movie entity
     *
     * @param MovieSummaryView $movieDTO
     * @param Movie $movie
     */
    private function mapToMovie(MovieSummaryView $movieDTO, Movie $movie): void
    {
        $movie->setTitle($movieDTO->getTitle());
        $movie->setFormat($movieDTO->getFormat());
        $movie->setLength($movieDTO->getLength());
        $movie->setReleaseYear($movieDTO->getReleaseYear());
        $movie->setRating($movieDTO->getRating());
    }

    /**
     * Build movie view
     *
     * @param Movie $movie
     * @return View
     */
    private function buildMovieView(Movie $movie): View
    {
        $movieMetadata = null;

        try {
            $movieMetadata = $this->metadataService->fetchByTitle($movie->getTitle());
        }
        catch (ClientException $exception) {
            if ($exception->getCode() !== Response::HTTP_NOT_FOUND){
                throw $exception;
            }
        }

        return new View(
            new MovieView($movie, $movieMetadata)
        );
    }
}
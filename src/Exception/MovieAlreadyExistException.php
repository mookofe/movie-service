<?php

namespace App\Exception;

use App\Entity\Movie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class MovieAlreadyExistException
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MovieAlreadyExistException extends HttpException
{
    /**
     * MovieAlreadyExistException constructor.
     *
     * @param Movie $movie
     * @param \Exception|null $previous
     */
    public function __construct(Movie $movie, \Exception $previous = null)
    {
        $message = sprintf('Movie with title "%s" and year "%s" already exist in our system', $movie->getTitle(), $movie->getReleaseYear());

        parent::__construct(Response::HTTP_BAD_REQUEST, $message, $previous);
    }
}
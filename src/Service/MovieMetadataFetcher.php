<?php
declare(strict_types = 1);

namespace App\Service;

use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\ResponseInterface;
use App\Integration\MetadataService\DTO\MovieMetadata;

/**
 * Class MovieMetadataFetcher
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MovieMetadataFetcher
{
    /**
     * @var Client
     */
    private $restClient;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var string
     */
    private $metadataServiceUrl;

    /**
     * MovieMetadataFetcher constructor.
     *
     * @param Client              $restClient
     * @param SerializerInterface $serializer
     * @param string              $metadataServiceUrl
     */
    public function __construct(Client $restClient, SerializerInterface $serializer, string $metadataServiceUrl)
    {
        $this->restClient = $restClient;
        $this->serializer = $serializer;
        $this->metadataServiceUrl = $metadataServiceUrl;
    }

    /**
     * Fet movie metadata by title
     *
     * @param string $title
     * @return MovieMetadata
     */
    public function fetchByTitle(string $title): MovieMetadata
    {
        $url = sprintf('%s/movie-meta-search?title=%s', $this->metadataServiceUrl, $title);
        $response = $this->restClient->get($url);

        return $this->deserializeResponse($response);
    }

    /**
     * Deserialize response to our internal DTO
     *
     * @param ResponseInterface $response
     * @return MovieMetadata
     */
    private function deserializeResponse(ResponseInterface $response): MovieMetadata
    {
        return $this->serializer->deserialize(
            (string)$response->getBody(),
            MovieMetadata::class,
            'json'
        );
    }
}
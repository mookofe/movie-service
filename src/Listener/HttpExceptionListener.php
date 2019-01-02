<?php

namespace App\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * Listen HTTP Exceptions and make a pretty response to the browser
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class HttpExceptionListener
{
    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        /** @var HttpException $exception */
        $exception = $event->getException();

        if (!$exception instanceof HttpException){
            return;
        }

        $body = [
            'status' => $exception->getStatusCode(),
            'message' => $exception->getMessage()
        ];

        $response = new JsonResponse($body, $exception->getStatusCode());
        $event->setResponse($response);
    }
}
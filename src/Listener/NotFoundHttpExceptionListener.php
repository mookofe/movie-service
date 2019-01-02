<?php

namespace App\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Listen HTTP Exceptions and make a pretty response to the browser
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class NotFoundHttpExceptionListener
{
    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        /** @var HttpException $exception */
        $exception = $event->getException();

        if (!$exception instanceof NotFoundHttpException){
            return;
        }

        $body = [
            'status' => $exception->getStatusCode(),
            'message' => 'Resource was not found with this ID'
        ];

        $response = new JsonResponse($body, $exception->getStatusCode());
        $event->setResponse($response);
    }
}
<?php

namespace App\EventSubscriber;

use App\Http\Error\WrongJson;
use App\Utils\DD;
use http\Env\Response;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class JsonCheckerSubscriber implements EventSubscriberInterface
{
    public function onKernelRequest(RequestEvent $event): void
    {
        if ($event->getRequest()->getContentType() !== 'json') {
            $jsonError = new WrongJson();
            $response = new JsonResponse($jsonError->getErrorMessage(), $jsonError->getCode());

            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}

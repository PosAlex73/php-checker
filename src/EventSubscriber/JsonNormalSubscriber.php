<?php

namespace App\EventSubscriber;

use App\Http\Error\WrongJson;
use App\Utils\DD;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class JsonNormalSubscriber implements EventSubscriberInterface
{
    public function onKernelController(ControllerEvent $event)
    {
        $request = $event->getRequest();
        $content = json_decode($request->getContent());



        return true;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}

<?php
// src/EventSubscriber/MenuSubscriber.php

namespace App\EventSubscriber;

use App\Repository\MenuRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

class MenuSubscriber implements EventSubscriberInterface
{
    private $menuRepository;
    private $twig;
    private $requestStack;

    public function __construct(MenuRepository $menuRepository, Environment $twig, RequestStack $requestStack)
    {
        $this->menuRepository = $menuRepository;
        $this->twig = $twig;
        $this->requestStack = $requestStack;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        // Make sure it's a controller class
        if (is_array($controller)) {
            $controller = $controller[0];
        }

        // Fetch menus for all controllers except for the MenuController itself
        if (!($controller instanceof MenuController)) {
            $menusparents = $this->menuRepository->findByParentIdIsNull();
            $menusfils = $this->menuRepository->findByParentIdIsNotNull();

            // Get the current request object
            $request = $this->requestStack->getCurrentRequest();

            // Get the current route name
            $currentRoute = $request->get('_route');

            // Pass the current route name to Twig
            $this->twig->addGlobal('currentRoute', $currentRoute);

            $this->twig->addGlobal('menusparents', $menusparents);
            $this->twig->addGlobal('menusfils', $menusfils);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}

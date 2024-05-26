<?php

namespace App\EventSubscriber;

use App\Service\SearchFormService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class SearchFormSubscriber implements EventSubscriberInterface
{

    public function __construct(private SearchFormService $searchFormService, private Environment $twig, private RequestStack $requestStack)
    {
    }
    public function onKernelController(): void
    {
        $form = $this->searchFormService->getSearchForm();
        $request = $this->requestStack->getCurrentRequest();
        $form->handleRequest($request);

        $this->twig->addGlobal('search_form', $form->createView());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}

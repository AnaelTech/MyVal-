<?php

namespace App\Service;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use App\Form\UserSearchType;

class SearchFormService
{
    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function getSearchForm(): FormInterface
    {
        return $this->formFactory->create(UserSearchType::class);
    }
}

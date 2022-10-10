<?php

namespace App\Controller;

use App\Entity\Ingredients;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class Find_Cocktails extends AbstractController
{
    public function __construct(
        private Find_ingredients $find_ingredients
    ) {}

    #[Route(
        path: '/ingredients/{id}/publication',
        name: 'book_post_publication',
        defaults: [
            '_api_resource_class' => Ingredients::class,
            '_api_operation_name' => 'Cocktails/ingredients/{id}',
        ],
        methods: ['GET'],
    )]
    public function __invoke(Ingredients $ingredients): Ingredients
    {
        $this->find_ingredients->handle($ingredients);

        return $ingredients;
    }
}
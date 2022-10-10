<?php
// api/src/Controller/BookController.php

namespace App\Controller;

use App\Entity\Ingredients;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class readIngredients extends AbstractController
{
    public function createPublication(Ingredients $ingredients, Find_ingredients $find_ingredients): Ingredients
    {
        return $find_ingredients->handle($ingredients);
    }
}
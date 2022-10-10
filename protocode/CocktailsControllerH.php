<?php

namespace App\Controller;

use App\Repository\CocktailsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;

class CocktailsController extends AbstractController
{
    #[Route('/cocktails', name: 'app_cocktails')]
    public function index(): Response
    {
        return $this->render('cocktails/index.html.twig', [
            'controller_name' => 'CocktailsController',
        ]);
    }    
    
    // CRUD READ ID ingredients
    /**
     * @Route("/cocktails/ingredients/{id}", name="find_ingredients", methods: ['GET'],)
     */                        
    public function chroniqueShow($id, CocktailsRepository $cocktailsRepository)
    {   
        $coktails = $cocktailsRepository->findAll($id); 
        $coktails2 = json_encode($coktails);
        $response = new JsonResponse(['data' => $coktails2]);
        // fonction find permet de récupérer un élement 
        // de la base de données grâce à son id
        // return $this->render('cocktails/index.html.twig', ['cocktails_ingredients' => $coktails]);
        return $response;
    }
}

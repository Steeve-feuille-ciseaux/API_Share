<?php

namespace App\Controller;

use App\Repository\CocktailsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CocktailsController extends AbstractController
{
    #[Route('/cocktails', name: 'app_cocktails')]
    public function index(): Response
    {
        return $this->render('cocktails/index.html.twig', [
            'controller_name' => 'CocktailsController',
        ]);
    }

    // REQUETE SQL
    public function test(): void
    {
        $this->addSql('SELECT cocktails.name FROM cocktails INNER JOIN ingredients_cocktails ON cocktails.id = ingredients_cocktails.cocktails_id WHERE ingredients_cocktails.ingredients_id = 9');
    }
    
    // CRUD READ BY ID
    /**
     * @Route("/chronique/{id}", name="chronique_show")
     */                        
    public function chroniqueShow($id, CocktailsRepository $cocktailsRepository)
    {
        $chronique = $cocktailsRepository->find($id); 
        // fonction find permet de récupérer un élement 
        // de la base de données grâce à son id
        return $this->render('chronique.html.twig', ['chronique' => $chronique]);
    }
}

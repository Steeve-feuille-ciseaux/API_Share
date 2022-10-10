<?php

namespace App\Controller;

use App\Repository\CocktailsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CocktailsController extends AbstractController
{    
    // CRUD READ ID ingredients
    /**
     * @Route("/cocktails/ingredients", name="find_ingredients", methods: ['GET'],)
     */                        
    public function chroniqueShow(CocktailsRepository $cocktailsRepository, SerializerInterface $serializer)
    {   
        $cocktails = $cocktailsRepository->findAll(); 

        // $postsNormalises = $normalizer->normalize($cocktails, null, ['groups' => 'cocktails:read']);

        $response = $this->json($cocktails, 200, [], ['groups' => 'read:collection']);

        /*
        $coktails2 = json_encode($cocktails);
        $response = new JsonResponse(['data' => $coktails2]);
        // fonction find permet de récupérer un élement 
        // de la base de données grâce à son id
        */
        // return $this->render('cocktails.html.twig', ['cocktails_ingredients' => $response]);
        return $response;
    }
}

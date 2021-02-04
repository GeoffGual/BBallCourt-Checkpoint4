<?php

namespace App\Controller;

use App\Form\SearchCityFormType;
use App\Repository\CourtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(CourtRepository $courtRepository, Request $request): Response
    {

        $search = $request->get('search');

        $recherche = $courtRepository->findLikeTown($search);


        return $this->render('court/index.html.twig', [
            'courts' => $recherche
        ]);
    }
}

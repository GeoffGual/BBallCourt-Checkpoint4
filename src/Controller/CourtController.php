<?php

namespace App\Controller;

use App\Entity\Court;
use App\Form\CourtType;
use App\Repository\CourtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/", name="court")
 */
class CourtController extends AbstractController
{
    /**
     * @Route("/", name="_index")
     */
    public function index(CourtRepository $courtRepository): Response
    {

        return $this->render('court/index.html.twig', [
            'courts' => $courtRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="_new")
     */
    public function new(Request $request): Response
    {
        $court = new Court();
        $form = $this->createForm(CourtType::class, $court);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $court->setUser($this->getUser());
            $entityManager->persist($court);
            $entityManager->flush();

            $this->addFlash('success', 'Ton terrain a bien été ajouté');

            return $this->redirectToRoute('court_index');

        }
        return $this->render('court/new.html.twig', ["form" => $form->createView()]);

    }
}

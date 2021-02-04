<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Court;
use App\Form\CommentType;
use App\Form\CourtType;
use App\Form\SearchCityFormType;
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
    public function index(CourtRepository $courtRepository, Request $request): Response
    {
        /*$form = $this->createForm(SearchCityFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $courts = $courtRepository->findLikeTown($search);
        } else {
            $courts = $courtRepository->findAll();
        }*/

        $courts = $courtRepository->findAll();

        return $this->render('court/index.html.twig', [
            'courts' => $courts,
            /*'form' => $form->createView(),*/
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
        return $this->render('court/new.html.twig', [
            "form" => $form->createView()
        ]);

    }

    /**
     * @Route("/addcomm", name="_addcomm")
     */
    public function addComm(Court $court,Request $request): Response
    {
        $comment = new Comment();
        $user = $this->getUser();
        $comm = $request->get($court->getId());
        $comment->setUser($user);
        $comment->setCourt($court->getId());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($comment);
        $entityManager->flush();


        return $this->redirectToRoute('court/index.html.twig', [

        ]);
    }
    
    
}

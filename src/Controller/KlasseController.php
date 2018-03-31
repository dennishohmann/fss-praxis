<?php

namespace App\Controller;

use App\Entity\Klasse;
use App\Form\KlasseType;
use App\Repository\KlasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/klasse")
 */
class KlasseController extends Controller
{
    /**
     * @Route("/", name="klasse_index", methods="GET")
     */
    public function index(KlasseRepository $klasseRepository): Response
    {
        return $this->render('klasse/index.html.twig', ['klasses' => $klasseRepository->findAll()]);
    }

    /**
     * @Route("/new", name="klasse_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $klasse = new Klasse();
        $form = $this->createForm(KlasseType::class, $klasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($klasse);
            $em->flush();

            return $this->redirectToRoute('klasse_index');
        }

        return $this->render('klasse/new.html.twig', [
            'klasse' => $klasse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="klasse_show", methods="GET")
     */
    public function show(Klasse $klasse): Response
    {
        return $this->render('klasse/show.html.twig', ['klasse' => $klasse]);
    }

    /**
     * @Route("/{id}/edit", name="klasse_edit", methods="GET|POST")
     */
    public function edit(Request $request, Klasse $klasse): Response
    {
        $form = $this->createForm(KlasseType::class, $klasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('klasse_edit', ['id' => $klasse->getId()]);
        }

        return $this->render('klasse/edit.html.twig', [
            'klasse' => $klasse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="klasse_delete", methods="DELETE")
     */
    public function delete(Request $request, Klasse $klasse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$klasse->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($klasse);
            $em->flush();
        }

        return $this->redirectToRoute('klasse_index');
    }
}

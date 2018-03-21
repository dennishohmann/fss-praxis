<?php

namespace App\Controller;

use App\Entity\Klasse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class KlasseController extends AbstractController
{
    /**
     * @Route("/Klasse", name="klasse_show")
     */
    public function listKlasse()
    {
        $klassen = $this->getDoctrine()->getRepository('App:Klasse')->findAll();

        return $this->render('article/klasse.html.twig', [
            'title' => 'Klassenliste',
            'klassen' => $klassen,
        ]);
    }

    /**
     * @Route("/Klasse/insert/{name}/{klassenlehrer}/{jahrgang}/"), name="klasse_insert")
     */
    public function insertKlasse($name, $klassenlehrer, $jahrgang)
    {
        $em = $this->getDoctrine()->getManager();

        $klasse = new Klasse();
        $klasse->setName($name);
        $klasse->setKlassenlehrer($klassenlehrer);
        $klasse->setJahrgang($jahrgang);


        $em->persist($klasse);
        $em->flush();

        return $this->redirectToRoute('klasse_show');
    }

    /**
     * @Route("/Klasse/update/{nr}/{name}/{klassenlehrer}/{jahrgang}", name="klasse_update")
     */
    public function updateKlasse($nr, $name, $klassenlehrer, $jahrgang)
    {
        $em = $this->getDoctrine()->getManager();

        $klasse = $this->getDoctrine()->getRepository('App:Klasse')->find($nr);

        if (!$klasse){
            throw $this->createNotFoundException('Die ID '.$nr.' nicht in der Tabelle gefunden');
        }
            $klasse->setName($name);
            $klasse->setKlassenlehrer($klassenlehrer);
            $klasse->setJahrgang($jahrgang);
            $klasse->setSus($sus);

        $em->flush();

        return $this->redirectToRoute('klasse_show');

    }

    /**
     * @Route("/Klasse/delete/{nr}", name="klasse_delete")
     */
    public function deleteKlasse($nr)
    {
        $em = $this->getDoctrine()->getManager();

        $klasse = $em->getRepository('App:Klasse')->find($nr);
            if (!$klasse){
                throw $this->createNotFoundException('Die ID '.$nr.' nicht in der Tabelle gefunden');
            }
        $em->remove($klasse);
        $em->flush();

        return $this->redirectToRoute('klasse_show');
    }
}

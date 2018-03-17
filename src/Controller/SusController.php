<?php

namespace App\Controller;

use App\Entity\Sus;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SusController extends AbstractController
{
    /**
     * @Route("/Sus", name="sus_show")
     */
    public function showSus()
    {
        $Sus = $this->getDoctrine()->getRepository('App:Sus')->findAll();

        return $this->render('article/sus.html.twig', [
            'title' => 'Schülerliste',
            'sus' => $Sus,
        ]);
    }

    /**
     * @Route("/Sus/insert/{name}/{vname}"), name="sus_insert")
     */
    public function insertSus($name, $vname)
    {
        $em = $this->getDoctrine()->getManager();

        $sus = new Sus();
        $sus->setName($name);
        $sus->setVname($vname);

        $em->persist($sus);
        $em->flush();

        return $this->redirectToRoute('sus_show');
    }

    /**
     * @Route("/Sus/update/{nr}/{name}/{vname}", name="sus_update")
     */
    public function updateSus($nr, $name, $vname)
    {
        $em = $this->getDoctrine()->getManager();

        $sus = $this->getDoctrine()->getRepository('App:Sus')->find($nr);

        if (!$sus){
            throw $this->createNotFoundException('Die ID '.$nr.' nicht in der Tabelle gefunden');
        }
            $sus->setName($name);
            $sus->setVname($vname);

        $em->flush();

        return $this->redirectToRoute('sus_show');

    }

    /**
     * @Route("/Sus/delete/{nr}", name="sus_delete")
     */
    public function deleteSus($nr)
    {
        $em = $this->getDoctrine()->getManager();

        $sus = $em->getRepository('App:Sus')->find($nr);
            if (!$sus){
                throw $this->createNotFoundException('Die ID '.$nr.' nicht in der Tabelle gefunden');
            }
        $em->remove($sus);
        $em->flush();

        return $this->redirectToRoute('sus_show');
    }
}

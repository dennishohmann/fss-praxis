<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentController extends AbstractController
{
    /**
     * @Route("/Student", name="student_show")
     */
    public function showSus()
    {
        $students = $this->getDoctrine()->getRepository('App:Student')->findAll();

        return $this->render('article/sus.html.twig', [
            'title' => 'Schülerliste',
            'sus' => $students,
        ]);
    }

    /**
     * @Route("/Student/insert/{name}/{vname}"), name="sus_insert")
     */
    public function insertSus($name, $vname)
    {
        $em = $this->getDoctrine()->getManager();

        $sus = new Student();
        $sus->setName($name);
        $sus->setVname($vname);

        $em->persist($sus);
        $em->flush();

        return $this->redirectToRoute('sus_show');
    }

    /**
     * @Route("/Student/update/{nr}/{name}/{vname}", name="sus_update")
     */
    public function updateSus($nr, $name, $vname)
    {
        $em = $this->getDoctrine()->getManager();

        $sus = $this->getDoctrine()->getRepository('Student.php')->find($nr);

        if (!$sus){
            throw $this->createNotFoundException('Die ID '.$nr.' nicht in der Tabelle gefunden');
        }
            $sus->setName($name);
            $sus->setVname($vname);

        $em->flush();

        return $this->redirectToRoute('sus_show');

    }

    /**
     * @Route("/Student/delete/{nr}", name="sus_delete")
     */
    public function deleteSus($nr)
    {
        $em = $this->getDoctrine()->getManager();

        $sus = $em->getRepository('Student.php')->find($nr);
            if (!$sus){
                throw $this->createNotFoundException('Die ID '.$nr.' nicht in der Tabelle gefunden');
            }
        $em->remove($sus);
        $em->flush();

        return $this->redirectToRoute('sus_show');
    }
}

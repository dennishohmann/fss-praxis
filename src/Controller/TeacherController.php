<?php

namespace App\Controller;

use App\Entity\Teacher;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeacherController extends AbstractController
{
    /**
     * @Route("/Teacher", name="teacher_show")
     */
    public function showTeacher()
    {
        $teachers = $this->getDoctrine()->getRepository('App:Teacher')->findAll();

        return $this->render('article/teacher.html.twig', [
            'title' => 'Lehrerliste',
            'teachers' => $teachers,
        ]);
    }

    /**
     * @Route("/Teacher/insert/{name}/{vname}/{klasse}"), name="lehrer_insert")
     */
    public function insertLehrer($name, $vname, $klasse)
    {
        $em = $this->getDoctrine()->getManager();

        $lehrer = new Teacher();
        $lehrer->setName($name);
        $lehrer->setVname($vname);
        $lehrer->setKlasse($klasse);

        $em->persist($lehrer);
        $em->flush();

        return $this->redirectToRoute('lehrer_show');
    }

    /**
     * @Route("/Teacher/update/{nr}/{name}/{vname}", name="lehrer_update")
     */
    public function updateLehrer($nr, $name, $vname)
    {
        $em = $this->getDoctrine()->getManager();

        $lehrer = $this->getDoctrine()->getRepository('Teacher.php')->find($nr);

        if (!$lehrer){
            throw $this->createNotFoundException('Die ID '.$nr.' nicht in der Tabelle gefunden');
        }
            $lehrer->setName($name);
            $lehrer->setVname($vname);

        $em->flush();

        return $this->redirectToRoute('lehrer_show');

    }

    /**
     * @Route("/Teacher/delete/{nr}", name="lehrer_delete")
     */
    public function deleteLehrer($nr)
    {
        $em = $this->getDoctrine()->getManager();

        $lehrer = $em->getRepository('Teacher.php')->find($nr);
            if (!$lehrer){
                throw $this->createNotFoundException('Die ID '.$nr.' nicht in der Tabelle gefunden');
            }
        $em->remove($lehrer);
        $em->flush();

        return $this->redirectToRoute('lehrer_show');
    }
}

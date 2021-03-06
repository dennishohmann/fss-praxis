<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/student")
 */
class StudentController extends Controller
{
    /**
     * @Route("/", name="student_index", methods="GET")
     */
    public function indexByTeacher(StudentRepository $studentRepository): Response
    {
        $me = $this->container->get('security.token_storage')->getToken()->getUser();
        return $this->render('student/index.html.twig', [
            'students' => $studentRepository->findByTeacher($me)]);
    }

    /**
     * @Route("/list", name="student_list_all", methods="GET")
     *
     * ///TODO Zugriff nur für Admins gestatten ///
     */
    public function index(StudentRepository $studentRepository): Response
    {
        return $this->render('student/index.html.twig', ['students' => $studentRepository->findAll()]);
    }

    /**
     * @Route("/new", name="student_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/new.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_show", methods="GET")
     */
    public function show(Student $student): Response
    {
        return $this->render('student/show.html.twig', ['student' => $student]);
    }

    /**
     * @Route("/{id}/edit", name="student_edit", methods="GET|POST")
     */
    public function edit(Request $request, Student $student): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_edit', ['id' => $student->getId()]);
        }

        return $this->render('student/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_delete", methods="DELETE")
     */
    public function delete(Request $request, Student $student): Response
    {
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($student);
            $em->flush();
        }

        return $this->redirectToRoute('student_index');
    }

    /**
     * @Route("/print/list", name="student_list_print")
     */
    public function printListByTeacher(Request $request, StudentRepository $studentRepository): Response
    {
        $snappy = $this->get('knp_snappy.pdf');
        $me = $this->container->get('security.token_storage')->getToken()->getUser();
        $filename = 'Schuelerliste';
        /*$html for direct Raponst (Problem with embedded Pictures and css*/
        $html =   $this->render('student/index.html.twig', [
            'students' => $studentRepository->findByTeacher($me)]);

        /*Return File-View in Browser*/

        return new Response($snappy->getOutputFromHtml($html),200, array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"',
            )
        );
/*
 * Return file Download
 *         return new PdfResponse(
            $snappy->getOutputFromHtml($html), $filename
        );*/
//        $me = $this->container->get('security.token_storage')->getToken()->getUser();
//        return $this->render('student/index.html.twig', [
//            'students' => $studentRepository->findByTeacher($me)]);
    }
}

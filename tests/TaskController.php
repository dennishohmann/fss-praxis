<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TaskController extends AbstractController
{
    /**
     * @Route("/task", name="task")
     */
    public function new(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }

        /*
         * Be aware that the createView() method should be called
         * after handleRequest() is called. Otherwise,
         * changes done in the *_SUBMIT events aren't applied to the view
         * (like validation errors).
         *
         * */

        return $this->render('article/task.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    /*
     *      Handling Form Submissions
     *
     *  By default, the form will submit a POST request back to the same controller that renders it.
     * Here, the second job of a form is to translate user-submitted data back to the properties of an object.
     * To make this happen, the submitted data from the user must be written into the Form object.
     *
     *  This controller follows a common pattern for handling forms and has three possible paths:
     *
     * -    When initially loading the page in a browser, the form is created and rendered.
     *      handleRequest() recognizes that the form was not submitted and does nothing.
     *      isSubmitted() returns false if the form was not submitted.
     *
     * -    When the user submits the form, handleRequest() recognizes this and immediately
     *      writes the submitted data back into the task and dueDate properties of the $task object.
     *      Then this object is validated. If it is invalid (validation is covered in the next section),
     *      isValid() returns false and the form is rendered again, but now with validation errors;
     *
     * -    When the user submits the form with valid data, the submitted data is again written
     *      into the form, but this time isValid() returns true. Now you have the opportunity to
     *      perform some actions using the $task object (e.g. persisting it to the database)
     *      before redirecting the user to some other page (e.g. a "thank you" or "success" page).
     *
     * Note: Redirecting a user after a successful form submission prevents the user from being
     *      able to hit the "Refresh" button of their browser and re-post the data.
     *
     * If you need more control over exactly when your form is submitted or which data is passed to it,
     * you can use the submit() method. Read more about it Calling Form::submit() manually.
     * */


  /*      return $this->createForm('App\Form\TaskType'::class, $task);
    }*/

  /**
   * @Route("task/success", name="task_success")
   */
  public function taskSuccess()
  {
      return new Response('<html><body>Task success!</body></html>');
  }
}

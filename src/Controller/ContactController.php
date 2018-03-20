<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Service\CreateArticleRequest;
use App\Service\UpdateArticleRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    /**
     * @Route("/article/create/", name="article_create")
     */
    public function createAction(Request $request, Article $article)
    {
        // create an instance of an empty CreateArticleRequest
        $createArticleRequest = new CreateArticleRequest();

        // create a form but with a request object instead of entity
        $form = $this->createForm(ArticleType::class, $createArticleRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // ArticleFacade creates instance of an Article,
            // persists it and flushes the EntityManager.
            // (details are out of scope of this article)

            $article = $this->articleFacade->createArticle(
                $createArticleRequest->title,
                $createArticleRequest->content,
                $createArticleRequest->publishDate
            );

            // ... use $article to add title to flash message or something

            return $this->redirectToRoute('articles_list');
        }

        // render the form if it is the first request or if the validation failed
        return $this->render('article/add-article.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article/update/{id}/", name="article_update")
     */
    public function updateAction(Article $article, Request $request)
    {
        // the $article argument is converted from {id} by implicit ParamConverter

        // pre-populate the UpdateArticleRequest instance with the data from the article
        $updateArticleRequest = UpdateArticleRequest::fromArticle($article);

        $form = $this->createForm(UpdateArticleFormType::class, $updateArticleRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // ArticleFacade updates instance of an Article and flushes the EntityManager.
            // (details are out of scope of this article)

            $this->articleFacade->updateArticle(
                $article,
                $updateArticleRequest->title,
                $updateArticleRequest->content
            );

            // ... use $article to add title to flash message or something

            return $this->redirectToRoute('articles_list');
        }

        return $this->render('article/edit-article.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleComment;
use App\Form\ArticleType;
use App\Form\CommentType;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\MarkdownHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->redirectToRoute('article_list');
    }

    /**
     * @Route("/news/{slug}", name="news_show")
     */
    public function news($slug, MarkdownHelper $markdownHelper)
    {
        $commentsa = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];
        
                $articleContent = <<<EOF
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
**turkey** shank eu pork belly meatball non cupim.
Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
occaecat lorem meatball prosciutto quis strip steak.
Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
fugiat.
EOF;
        
        
         $articleContent = $markdownHelper->parse($articleContent);
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('App:Article')->findOneBy(['slug' => $slug]);
        $author = $em->getRepository('App:User')->find($article);

        return $this->render('article/article_show.html.twig', [
            'article' => $article,
            'author' => $author
        ]);

/*        return $this->render('article/index.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
            'comments' => $comments,
            'articleContent' => $articleContent,
        ]);*/
    }
    
    
    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        //TODO - actually heart/unheart the article
        
        $logger->info('Article is being hearted');
        
        return $this->json(['hearts' => rand(5,100)]);
    }


    /**
     * @Route("/article", name="article_list")
     */
    public function articleList()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('App:Article')
            ->findAllAuthorName();

        return $this->render('article/article_list.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/article/show/{id}", name="article_show")
     */
    public function show($id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('App:Article')->find($id);
        $author = $em->getRepository('App:User')->find($article);

        return $this->render('article/article_show.html.twig', [
            'article' => $article,
            'author' => $author
        ]);
    }


    /**
     * @Route("/article/neu", name="article_new")
     */
    public function new(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $article = new Article();
        $article->setContent('Write a blog post');
        $article->setTitle('Title');
        $article->setPublishDate(new \DateTime('today'));
        $article->setUser($this->getUser());

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $article = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
            $this->addFlash('success', '<h2>Artikel erfolgreich angelegt</h2>');
            return $this->redirectToRoute('article_list', array(
                'message' => 'Alles eingetragen',
            ));
            //TODO: Message erscheint als GET im Aufruf, nicht in TWIG
        }

        /*
         * Be aware that the createView() method should be called
         * after handleRequest() is called. Otherwise,
         * changes done in the *_SUBMIT events aren't applied to the view
         * (like validation errors).
         *
         * */

        return $this->render('article/article_new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/article/show/{id}/comments", name="article_show_comments", options={"expose" = true})
     * ///@Method("GET")
     */
    public function getCommentsAction(Article $article)
    {
        $comments = [];
        foreach ($article->getComments() as $comment) {
            $comments[] = [
                'id' => $comment->getId(),
                'username' => $comment->getUser()->getUsername(),
                'avatarUri' => '/images/'.$comment->getUserAvatarFilename(),
                'note' => $comment->getComment(),
                'date' => $comment->getCreatedAt()->format('D d M Y')
            ];
        }
        $data = [
            'comments' => $comments
        ];
        return new JsonResponse($data);
    }

 /**
 * @Route("/article/show/addcomment/{article}", name="article_add_comment", options={"expose" = true})
 * ///@Method("GET")
 */
    public function addCommentAction(Article $article)
    {
        // creates a task and gives it some dummy data for this example
        $articleComment = new ArticleComment();
        $articleComment->setUser($this->getUser());
        $articleComment->setComment('Comment');
        $articleComment->setCreatedAt(new \DateTime('today'));
        $articleComment->setArticle($this->getArticle());

        $form = $this->createForm(CommentType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $articleComment = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_list', array(
                'message' => 'Alles eingetragen',
            ));
            //TODO: Message erscheint als GET im Aufruf, nicht in TWIG
        }

        /*
         * Be aware that the createView() method should be called
         * after handleRequest() is called. Otherwise,
         * changes done in the *_SUBMIT events aren't applied to the view
         * (like validation errors).
         *
         * */

        return $this->render('article/article_new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

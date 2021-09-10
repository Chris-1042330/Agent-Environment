<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
//    /**
//     *@Route("/article", name="article")
//     */
    public function index(){
        $articles = ['Article1', 'Article2'];

        return $this->render('articles/index.html.twig', array('articles' => $articles));
    }
//    public function createArticle(): Response{
//        // you can fetch the EntityManager via $this->getDoctrine()
//        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $article = new Article();
//        $article->setTitle('Keyboard');
//        $article->setBody('aaaaaaaa');
//
//        // tell Doctrine you want to (eventually) save the Product (no queries yet)
//        $entityManager->persist($article);
//
//        // actually executes the queries (i.e. the INSERT query)
//        $entityManager->flush();
//
//        return new Response('Saved new product with id '.$article->getId());
//    }
//
//    /**
//     * @Route("/article/{id}", name="article_show")
//     */
//    public function show(int $id, ArticleRepository $articleRepository): Response
//    {
//        $article = $articleRepository
//            ->find($id);
//
//        // ...
//    }


}

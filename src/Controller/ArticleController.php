<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/', name: 'article')]
    public function index(){
        $articles = ['Article1', 'Article2'];

        return $this->render('articles/index.html.twig', array('articles' => $articles));
    }

}

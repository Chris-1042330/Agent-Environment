<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     *@Route("/adm/article", name="article")
     */
    public function index(): Response{
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('articles/index.html.twig', array('articles' => $articles));
    }

    /**
     * @Route("/adm/article/save", name="article_save")
     */
    public function save(): Response{
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setTitle('');
        $article->setBody('');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($article);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$article->getId());
    }

    /**
     * @Route("/adm/article/edit/{id}", name="article_edit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, $id): Response{
        $article = new Article();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $form = $this->createFormBuilder($article)
            ->add('title', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('attr' => array('class' => 'form-control')
            ))
            ->add('body', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array('label' => 'Save', 'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('article');
        }

        return $this->render('articles/edit.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/adm/article/new", name="article_new")
     */
    public function new(Request $request): Response{
        $article = new Article();

        $form = $this->createFormBuilder($article)
            ->add('title', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('attr' => array('class' => 'form-control')
            ))
            ->add('body', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article');
        }

        return $this->render('articles/new.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/adm/article/delete/{id}")
     */
    public function delete(Request $request, $id){
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
    /**
     * @Route("/adm/article/{id}", name="article_show")
     */
    public function show(int $id, ArticleRepository $articleRepository): Response    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        return $this->render('articles/show.html.twig', array('article' => $article));
    }

}

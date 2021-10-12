<?php

namespace App\Controller;

use App\Entity\Content;
use App\Repository\ContentRepository;
use Doctrine\DBAL\Types\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContentController extends AbstractController
{
    /**
     *@Route("/artikelen", name="content")
     */
    public function index(): Response{
        $contents = $this->getDoctrine()->getRepository(Content::class)->findAll();
        return $this->render('content/index.html.twig', array('content' => $contents));
    }

    /**
     * @Route("/artikelen/save", name="content_save")
     */
    public function save(): Response{
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $content = new Content();
        $content->setTitle('');
        $content->setBody('');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($content);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$content->getId());
    }

    /**
     * @Route("/artikelen/edit/{id}", name="content_edit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, $id): Response{
        $content = new Content();
        $content = $this->getDoctrine()->getRepository(Content::class)->find($id);

        $form = $this->createFormBuilder($content)
            ->add('title', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('attr' => array('class' => 'form-control')
            ))
            ->add('content', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array('label' => 'Save', 'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->add('delete', SubmitType::class, array('label' => 'Delete', 'attr' => array('class' => 'btn btn-danger mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('content');
        }

        return $this->render('content/edit.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/artikelen/new", name="content_new")
     */
    public function new(Request $request): Response{
        $content = new Content();

        $form = $this->createFormBuilder($content)
            ->add('title', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('attr' => array('class' => 'form-control')
            ))
            ->add('body', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $content = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($content);
            $entityManager->flush();

            return $this->redirectToRoute('content');
        }

        return $this->render('content/new.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/artikelen/delete/{id}")
     */
    public function delete(Request $request, $id){
        $content = $this->getDoctrine()->getRepository(Content::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($content);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
    /**
     * @Route("/artikelen/{id}", name="content_show")
     */
    public function show(int $id, ContentRepository $contentRepository): Response    {
        $content = $this->getDoctrine()->getRepository(Content::class)->find($id);
        return $this->render('content/show.html.twig', array('content' => $content));
    }

}

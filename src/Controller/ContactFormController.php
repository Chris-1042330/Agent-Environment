<?php

namespace App\Controller;

use App\Entity\ContactFormEntity;
use App\Form\ContactFormEntityType;
use App\Repository\ContactFormEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact')]
class ContactFormController extends AbstractController
{
    #[Route('', name: 'contact_form_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $contactFormEntity = new ContactFormEntity();
        $form = $this->createForm(ContactFormEntityType::class, $contactFormEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contactFormEntity);
            $entityManager->flush();

            return $this->redirectToRoute('contact_form_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_form/new.html.twig', [
            'contact_form_entity' => $contactFormEntity,
            'form' => $form,
        ]);
    }
}

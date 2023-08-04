<?php

namespace App\Controller;

use App\Entity\NewsletterReader;
use App\Form\NewsletterReaderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter', name: 'app_newsletter')]
    public function index(Request $request): Response
    {
        dump($request);
        $newletter = new NewsletterReader();
        $form = $this->createForm(NewsletterReaderType::class, $newletter);
        $form->handleRequest($request);
        $newsletter = $form->getData();
        $newletter->setCreatedAt(new \DateTimeImmutable());
        $newletter->setIsActived(true);
        $form->setData($newsletter);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form);
        }

        return $this->render('newsletter/index.html.twig', [
            'form' => $form
        ]);
    }
}

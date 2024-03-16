<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Offer;
use App\File\Uploader\FileUploader;
use App\Form\Type\ApplicationType;
use App\Handler\ApplicationHandlerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OfferController extends AbstractController
{
    #[Route('/browse/{slugCategory}/{slug}', name: 'app_offer')]
    public function index(
        #[MapEntity(expr: 'repository.findOffer(slugCategory, slug)')] Offer $offer,
        Request $request,
        ApplicationHandlerInterface $handler,
        FileUploader $fileUploader
    ): Response {
        $application = new Application();
        $application->setOffer($offer);

        $form = $this->createForm(ApplicationType::class, $application);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $attachment = $fileUploader->upload($form->get('attachment_file')->getData());
            $application->setAttachment($attachment);
            
            $handler->handle($application);

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('offer/index.html.twig', [
            'offer' => $offer,
            'form' => $form,
        ]);
    }
}

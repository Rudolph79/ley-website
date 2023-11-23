<?php

namespace App\Controller;

use App\Entity\Offer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfferController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @Route("/offres", name="app_offer")
     */
    public function index(): Response
    {
        $offers = $this->entityManager->getRepository(Offer::class)->findAll();
        // dd($offers);
        
        return $this->render('offer/offer.html.twig', [
            'offers' => $offers
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        $offers = $this->entityManager->getRepository(Offer::class)->findAll();
        $articles = $this->entityManager->getRepository(Post::class)->findTheLastThreeItems();
        // dd($articles);

        return $this->render('home/index.html.twig', [
            'offers' => $offers,
            'articles' => $articles
        ]);
    }
}

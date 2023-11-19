<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/articles", name="app_articles")
     */
    public function index(): Response
    {
        $posts = $this->entityManager->getRepository(Post::class)->findAll();

        return $this->render('article/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/article/{id}", name="article")
     */
    public function show($id)
    {
        $post = $this->entityManager->getRepository(Post::class)->findOneById($id);

        if (!$post) {
            return $this->redirectToRoute('app_articles');
        }

        return $this->render('article/show.html.twig', [
            'post' => $post
        ]);
    }
}

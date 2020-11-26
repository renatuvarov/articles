<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/", methods={"get"}, name="index")
     *
     * @param CategoryRepository $repository
     * @return Response
     */
    public function index(CategoryRepository $repository)
    {
        try {
            $categories = $repository->findAll();
        } catch (Exception $e) {
            $categories = [];
        }

        return $this->render('articles/index.html.twig', compact('categories'));
    }

    /**
     * @Route("/articles", methods={"post"}, name="articles")
     *
     * @param Request $request
     * @param CategoryRepository $repository
     * @return Response
     */
    public function articles(Request $request, CategoryRepository $repository): Response
    {
        try {
            $category = $repository->getById($request->get('category'));
        } catch (Exception $e) {
            return $this->json(['error' => 'Неизвестная категория']);
        }

        $articles = $category->getArticles();

        return $articles->isEmpty() ? new Response('end') : $this->json($articles);
    }
}

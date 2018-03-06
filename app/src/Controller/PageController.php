<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(ProductRepository $repository)
    {
        $images =$repository->findImages();

        if (!$images) {
            throw $this->createNotFoundException('There are not $products in data base!');
        }

        $products = $repository->findAll();

        if (!$products) {
            throw $this->createNotFoundException('There are not $products in data base!');
        }

        return $this->render('page/index.html.twig', [
            'products' => $products,
            'images' => $images,
        ]);
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function categories(CategoryRepository $repository)
    {
        $categories = $repository->findAll();

        if (!$categories) {
            throw $this->createNotFoundException('There are not categories in data base!');
        }

        return $this->render('page/categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{id}", name="category", requirements={"\d+"})
     */
    public function category($id, ProductRepository $repository)
    {
        $products = $repository->findByCategory($id);

        if (!$products) {
            throw $this->createNotFoundException('There are not products with this category in data base!');
        }

        return $this->render('page/products.html.twig', [
            'products' => $products,
        ]);
    }
}

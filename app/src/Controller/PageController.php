<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
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

        $products = $repository->findAllDesk();

        if (!$products) {
            throw $this->createNotFoundException('There are not $products in data base!');
        }

        return $this->render('page/index.html.twig', [
            'products' => $products,
            'images' => $images,
        ]);
    }

    /**
     * @Route("/product/{id}", name="product", requirements={"\d+"})
     */
    public function product(Product $product)
    {
        if (!$product) {
            throw $this->createNotFoundException('There is not product with this id in data base!');
        }

        return $this->render('page/product.html.twig', [
            'product' => $product,
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

        return $this->render('page/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/tags", name="tags")
     */
    public function tags(TagRepository $repository)
    {
        $tags = $repository->findAll();

        shuffle($tags);

        if (!$tags) {
            throw $this->createNotFoundException('There are not categories in data base!');
        }

        return $this->render('page/tags.html.twig', [
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/tag/{id}", name="tag", requirements={"\d+"})
     */
    public function tag($id, TagRepository $repository)
    {
        $tag = $repository->find($id);
        $products = $tag->getProducts();

        if (!$tag) {
            throw $this->createNotFoundException('There is not tag wit this id!');
        }

        return $this->render('page/products.html.twig', [
            'products' => $products,
        ]);
    }
}

<?php
// src/Controller/CategoryController.php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
* @Route("/categories", name="category_")
*/
class CategoryController extends AbstractController
{
     /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
         ]);
    }

     /**
     * @Route ("/{categoryName}", methods={"GET"}, name="show")
     */
    public function show(string $categoryName): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);

        if (!$categories) {
            throw $this->createNotFoundException(
                'Sorry we have not this category in our product'
            );
        }

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findBy(['category' => $categories->getId()], ['id' => 'DESC'],3);

        return $this->render('category/show.html.twig', [
            'products' => $products,
            'categories' => $categories,

        ]);
    }
} 

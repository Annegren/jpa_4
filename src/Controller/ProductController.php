<?php
// src/Controller/ProductController.php
namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/products", name="product_")
*/ 
class ProductController extends AbstractController
{

    /**
     * Show all rows from Product's enttity 
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
        public function index(): Response
        {
        $products = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findAll();
        
        return $this->render('product/index.html.twig', [
            'products' => $products]
        );
        
    }
 /**
  * @Route ("/{id}", requirements={"id"="\d+"}, methods={"GET"}, name="show")
  */
  public function show(int $id):Response
    {
        $product = $this->getDoctrine()
          ->getRepository(Product::class)
          ->findOneBy(['id' => $id]);

      if (!$product) {
          throw $this->createNotFoundException(
              'No product with id : '.$id.' found in product\'s table.'
          );
      }
      return $this->render('product/show.html.twig', [
          'product' => $product,
      ]);
  }

}

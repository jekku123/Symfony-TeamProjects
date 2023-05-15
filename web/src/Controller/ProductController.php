<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Product;


class ProductController extends AbstractController
{
    #[Route('/product/{page}', name: 'product', defaults: ['page' => 1])]
    public function index(int $page, EntityManagerInterface $entityManager): Response
    {
        // Must have an ORM entity for the product table
        $productsRepository = $entityManager->getRepository(Product::class);

        $limit = 3; // Number of products per page

        // Get the total number of products
        $totalProducts = $productsRepository->count([]);

        // Calculate the total number of pages
        $totalPages = ceil($totalProducts / $limit);

        // Ensure the requested page is within the valid range
        $page = max(1, min($page, $totalPages));

        // Calculate the offset for pagination
        $offset = ($page - 1) * $limit;

        // Fetch the products for the current page
        $products = $productsRepository->findBy([], null, $limit, $offset);

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'page' => $page,
            'totalPages' => $totalPages,
        ]);
    }
}

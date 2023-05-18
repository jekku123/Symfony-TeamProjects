<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Event;


class EventController extends AbstractController
{
    #[Route('/event/{page}', name: 'app_event', defaults: ['page' => 1])]
    public function index(int $page, EntityManagerInterface $entityManager): Response
    {
        // Must have an ORM entity for the product table
        $eventRepository = $entityManager->getRepository(Event::class);

        $limit = 3; // Number of products per page

        // Get the total number of products
        $totalEvents = $eventRepository->count([]);

        // Calculate the total number of pages
        $totalPages = ceil($totalEvents / $limit);

        // Ensure the requested page is within the valid range
        $page = max(1, min($page, $totalPages));

        // Calculate the offset for pagination
        $offset = ($page - 1) * $limit;

        // Fetch the products for the current page
        $events = $eventRepository->findBy([], null, $limit, $offset);

        return $this->render('events/index.html.twig', [
            'events' => $events,
            'page' => $page,
            'totalPages' => $totalPages,
        ]);
    }
}

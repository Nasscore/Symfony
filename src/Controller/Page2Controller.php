<?php

namespace App\Controller;

use App\Entity\Owner;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Page2Controller extends AbstractController
{
    /**
     * @Route("/page2", name="page2")
     */
    public function index(): Response
    {
        $animal = new Animal();
        $owner = new Owner();
        return $this->render('page2/index.html.twig', [
            'controller_name' => 'Page2Controller',
        ]);
    }
}

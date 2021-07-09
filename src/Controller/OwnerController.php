<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OwnerController extends AbstractController
{
    /**
     * @Route("/owner", name="owner")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        dump($user);
        $toto = 'toto';
        $tata = 'Les chaussettes de l\'archiduchesse sont elles seches ? Archi seche';
        return $this->render('owner/index.html.twig', [
            'controller_name' => 'OwnerController',
            'titi' => $tata,
            'tata'=> $tata

        ]);
    }

    /**
     * @Route("/owner-second/{param}", name="owner-second")
     */

    public function indexSecond(string $param){
        return $this->render('owner/index.html.twig', [
            'controller_name' => 'OwnerController',

        ]);
    }
}

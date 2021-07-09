<?php

namespace App\Controller;

use App\Entity\Owner;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Exo1Controller extends AbstractController
{
    /**
     * @Route("/exo1", name="exo1")
     */
    public function exo1(): Response
    {
        $exo = 'On en a gros ! ';
        return $this->render('exo1/index.html.twig', [
            'controller_name' => 'Exo1Controller',
            'exo' => $exo,
        ]);
    }
    /**
     * @Route("/exo2/{prenom}", name="exo2")
     */
    public function exo2(string $prenom): Response
    {
       $owner = new Owner();
       $owner->setFirstName($prenom);
        return $this->render('exo2/index.html.twig', [
            'controller_name' => 'Exo1Controller',
            'exo2' => $owner->getFirstName()

        ]);
    }
    /**
     * @Route("/exo3/{nb}/{operateur}/{nb2}", name="exo3")
     */
    public function exo3(int $nb, string $operateur, int $nb2): Response
    {
        if($operateur == 'add'){
            $result = $nb + $nb2;
        }
        else if($operateur == 'divide'){
            $result = $nb/$nb2;
        }
        else if($operateur == 'substract'){
            $result = $nb-$nb2;
        }
        else if($operateur == 'multiply'){
            $result = $nb * $nb2;
        }
        else {
            $result = 'Veuillez entrer un operateur valide';
        }

        return $this->render('exo3/index.html.twig', [
            'controller_name' => 'Exo1Controller',
            'result' => $result

        ]);
    }
    /**
     * @Route("/exo4", name="exo4")
     */
    public function exo4(): Response
    {

        return $this->redirectToRoute('exo1');
    }

    /**
     * @Route("/exo5", name="exo5")
     */
    public function exo5(): Response
    {

        return $this->redirectToRoute('exo2', [
            'prenom'=>'june le singleton'

        ]);
    }
    /**
     * @Route("/exo6/{attribut}", name="exo6")
     */
    public function exo6(string $attribut = null): Response
    {

        return $this->render('exo6/index.html.twig', [


        ]);
    }

}

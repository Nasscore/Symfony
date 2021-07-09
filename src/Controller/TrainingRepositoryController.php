<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrainingRepositoryController extends AbstractController
{
    /**
     * @var AnimalRepository
     */
    private $animalRepository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * TrainingRepositoryController constructor.
     * @param AnimalRepository $animalRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(AnimalRepository $animalRepository, EntityManagerInterface $em)
    {
        $this->animalRepository = $animalRepository;
        $this->em = $em;
    }

    /**
     * @Route("/training/repository", name="training_repository")
     */
    public function index(): Response
    {
        $animalEntity = $this->animalRepository->find(1);
        dump($animalEntity);
        $animalEntity2 = $this->animalRepository->findOneBy(['nickName'=>'roger','type' =>'leopard']);
        dump($animalEntity2);
        $animalEntities = $this->animalRepository->findAll();
        dump($animalEntities);
        $animalEntity = $this->animalRepository->findBy(['nickName'=>'roger']);
        dump($animalEntity);
        return $this->render('training_repository/index.html.twig', [
            'controller_name' => 'TrainingRepositoryController',
        ]);
    }


    /**
     * @Route("/create-animal/repository", name="create_animal")
     */
    public function createAnimal(){
        $animalEntity = new Animal();
        $animalEntity->setNickName('loulou');
        $animalEntity->setType('loutre');

        /* persist = file d'attente, semblable au prepare de la requete sql */
        $this->em->persist($animalEntity);
        /* flush = execute, pousse tout les persiste dans la base de donnée */
        $this->em->flush();
        return $this->render('training_repository/index.html.twig', [
            'controller_name' => 'TrainingRepositoryController',
        ]);
    }
    /**
     * @Route("/update-animal/{id}", name="update_animal")
     */
    public function updateAnimal(string $id){
        $animalEntity = $this->animalRepository->find($id);
        $animalEntity->setNickName('truc');
        $this->em->persist($animalEntity);
        $this->em->flush();

        return $this->render('training_repository/index.html.twig', [
            'controller_name' => 'TrainingRepositoryController',
        ]);

    }
    /**
     * @Route("/remove-animal/{id}", name="remove_animal")
     */
    public function removeAnimal(string $id){
        $animalEntity = $this->animalRepository->find($id);
        $this->em->remove($animalEntity);
        $this->em->flush();

        return $this->render('training_repository/index.html.twig', [
            'controller_name' => 'TrainingRepositoryController',
        ]);

    }
}

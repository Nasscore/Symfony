<?php

namespace App\Controller;

use App\Entity\Owner;
use App\Repository\AnimalRepository;
use App\Repository\OwnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Page3Controller extends AbstractController
{
    /**
     * @var OwnerRepository
     */
    private $ownerRepository;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var AnimalRepository
     */
    private $animalRepository;

    /**
     * Page3Controller constructor.
     * @param OwnerRepository $ownerRepository
     * @param EntityManagerInterface $em
     * @param AnimalRepository $animalRepository
     */
    public function __construct(OwnerRepository $ownerRepository, EntityManagerInterface $em, AnimalRepository $animalRepository)
    {
        $this->ownerRepository = $ownerRepository;
        $this->em = $em;
        $this->animalRepository = $animalRepository;
    }


    /**
     * Page3Controller constructor.
     * @param OwnerRepository $ownerRepository
     * @param EntityManagerInterface $em
     */


    /**
     * TrainingRepositoryController constructor.
     * @param OwnerRepository $ownerRepository
     * @param EntityManagerInterface $em
     */
    /**
     * @Route("/exo-page3/exo7", name="exoPage3.7")
     */
    public function readOwner(): Response
    {
        $ownerEntities = $this->ownerRepository->findAll();
        dump($ownerEntities);

        return $this->render('page3/index.html.twig', [
            'controller_name' => 'Page3Controller',
        ]);
    }
    /**
     * @Route("/exo-page3/exo8/{id}", name="exoPage3.8")
     */
    public function ownerById($id): Response
    {
        $ownerEntity = $this->ownerRepository->find($id);
        dump($ownerEntity);

        return $this->render('page3/index.html.twig', [
            'controller_name' => 'Page3Controller',
        ]);
    }
    /**
     * @Route("/exo-page3/exo9/{prenom}", name="exoPage3.9")
     */
    public function ownerByName($prenom): Response
    {
        $ownerEntity = $this->ownerRepository->findOneBy(['firstName'=>$prenom]);
        dump($ownerEntity);
        $animalsOfOwner = $this->animalRepository->findBy(['owner'=>$ownerEntity->getId()]);
        dump($animalsOfOwner);
        return $this->render('page3/index.html.twig', [
            'controller_name' => 'Page3Controller',
        ]);
    }
    /**
     * @Route("/exo-page3/exo10/{firstName}/{lastName}", name="exoPage3.10")
     */
    public function addOwner(string $firstName,string $lastName): Response
    {
        $addOwner = new Owner();
        $addOwner->setFirstName($firstName);
        $addOwner->setLastName($lastName);
        $this->em->persist($addOwner);
        $this->em->flush();


        return $this->render('page3/index.html.twig', [
            'controller_name' => 'Page3Controller',
        ]);
    }
    /**
     * @Route("/exo-page3/exo11/{id}", name="exoPage3.11")
     */
    public function updateOwner(string $id){
        $ownerEntity = $this->ownerRepository->find($id);
        $ownerEntity->setFirstName('Alexandre');
        $this->em->persist($ownerEntity);
        $this->em->flush();

        return $this->render('page3/index.html.twig', [
            'controller_name' => 'Page3Controller',
        ]);

    }
    /**
     * @Route("/exo-page3/exo12/{firstName}", name="exoPage3.12")
     */
    public function removeOwner(string $firstName){
        $ownerEntities = $this->ownerRepository->findBy(['firstName'=>$firstName]);
        foreach ($ownerEntities as $ownerEntity){
            $this->em->remove($ownerEntity);
        }
        $this->em->flush();


        return $this->render('page3/index.html.twig', [
            'controller_name' => 'Page3Controller',
        ]);

    }
    /**
     * @Route("/exo-page3/exo13/{id}", name="exoPage3.13")
     */
    public function updateOwner2(int $id){
        $ownerEntity = $this->ownerRepository->find($id);
        $animalsOfOwner = $this->animalRepository->findBy(['owner'=>$ownerEntity->getId()]);
        foreach ($animalsOfOwner as $animal){
            $animal->setOwner(null);
            $this->em->persist($animal);
        }
        $this->em->flush();


        return $this->render('page3/index.html.twig', [
            'controller_name' => 'Page3Controller',
        ]);

    }
    /**
     * @Route("/exo-page3/exo14/{ageMini}/{ageMaxi}", name="exoPage3.14")
     */
    public function sortAnimalByAge(int $ageMini, int $ageMaxi){
      $animals =  $this->animalRepository->findByAgeMinAgeMax($ageMini,$ageMaxi);
      dump($animals);



        return $this->render('page3/index.html.twig', [
            'controller_name' => 'Page3Controller',
        ]);

    }



}

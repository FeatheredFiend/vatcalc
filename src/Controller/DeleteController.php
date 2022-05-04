<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class DeleteController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/delete/{id}', name: 'delete_row')]
    public function deleteRow(int $id, Request $request, ManagerRegistry $doctrine): Response
    {
        $conn = $this->entityManager->getConnection();

        $sql = "DELETE FROM vatcalc WHERE id = :val";
        var_dump($sql);
        $statement = $conn->prepare($sql);
        $statement->bindParam('val', $id);
        $statement->execute();
    
        return $this->redirectToRoute('homepage');
    }

    #[Route('/delete', name: 'delete_all')]
    public function deleteAll(Request $request, ManagerRegistry $doctrine): Response
    {
        $conn = $this->entityManager->getConnection();

        $sql = "DELETE FROM vatcalc";
        $statement = $conn->prepare($sql);
        $statement->execute();
    
        return $this->redirectToRoute('homepage');
    }
}

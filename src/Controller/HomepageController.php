<?php

namespace App\Controller;

use App\Entity\Vatcalc;
use App\Form\VatcalcType;
use App\Repository\VatcalcRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class HomepageController extends AbstractController
{

    #[Route('/homepage', name: 'homepage')]
    public function index(VatcalcRepository $vatcalcRepository, Request $request, PaginatorInterface $paginator, ManagerRegistry $doctrine): Response
    {

        $vatcalc = new Vatcalc();

        $form = $this->createForm(VatcalcType::class, $vatcalc);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Save
            $em = $doctrine->getManager();
            $em->persist($vatcalc);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $q = $request->query->get('q');
        $queryBuilder = $vatcalcRepository->getWithSearchQueryBuilder($q);

        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('homepage/index.html.twig', [
            'pagination' => $pagination,
            'form' => $form->createView(),
            'vatcalc' => $vatcalc
        ]);
    }
}

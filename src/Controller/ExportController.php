<?php

namespace App\Controller;
use App\Repository\VatcalcRepository;
use Knp\Component\Pager\PaginatorInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;




class ExportController extends AbstractController
{
    #[Route('/export', name: 'export')]
    public function index(VatcalcRepository $vatcalcRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $q = $request->query->get('q');
        $queryBuilder = $vatcalcRepository->getWithSearchQueryBuilder($q);

        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5000000000/*limit per page*/
        );

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $line = 2;

        foreach ($pagination as $ad ){
            $sheet = $spreadsheet->getActiveSheet()
            ->setCellValue('A1','Id')
            ->setCellValue('B1','Original Value')
            ->setCellValue('C1','Vat Rate')
            ->setCellValue('D1','Excluding VAT Cost')
            ->setCellValue('E1','Including VAT Cost')
            ->setCellValue('A' . $line, $ad['id'])
            ->setCellValue('B' . $line, $ad['value'])
            ->setCellValue('C' . $line, $ad['vat'])
            ->setCellValue('D' . $line, $ad['excludingvalue'])
            ->setCellValue('E' . $line, $ad['includingvalue']);
            $line++;

        }
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        header('Content-Disposition: attachment; filename=Export.csv');
        $writer->save('php://output');
        die;

        return $this->redirectToRoute('homepage');
    }
}

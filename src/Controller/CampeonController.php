<?php
namespace App\Controller;

use App\Entity\Campeon;
use App\Entity\Unidades;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampeonController extends AbstractController{
    public function get_champion (EntityManagerInterface $entityManager,EntityManagerInterface $manager,int $id_unidad):Response{

        $unidad = $entityManager -> getRepository(Unidades::class) -> find($id_unidad);
        $champion = $manager -> getRepository(Campeon::class) -> findOneBy(["id_unidad"=>$unidad]);

        if (!$champion){
            return new JsonResponse(null, Response::HTTP_OK);
        }

        $championObject = [
            'id' => $champion -> getId(),
            'id_unidad_id' => $champion -> getIdUnidad(),
            'puntos'  => $champion -> getPuntos(),
            'ptos_om'  => $champion -> getPtosOM(),
            'nombre' => $champion -> getNombre()
        ];
        return new JsonResponse($championObject, Response::HTTP_OK);
    }
}
?>
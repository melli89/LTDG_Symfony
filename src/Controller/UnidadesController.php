<?php
namespace App\Controller;

use App\Entity\Unidades;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


//Se debe de crear un entity manager que sirve como objeto que realiza las peticiones a la base de datos (doctrine).
    /**
     * @Route("/", methods={"GET"}, name="ejercitos")
     */
class UnidadesController extends AbstractController{

    public function units_list (EntityManagerInterface $manager): Response{

        $units_list = $manager ->getRepository(Unidades::class) -> findAll();
        $units = [];

        if(count($units_list)>0){
            foreach ($units_list as $unit){
                $units[] = $this-> unit_model($unit);
            }
        }
        return new JsonResponse($units, Response::HTTP_OK);
    }

    public function get_heroes (EntityManagerInterface $manager, int $id): Response{

        $heroes_list = $manager ->getRepository(Unidades::class) -> findBy(['categoria' => 'Personaje']);
        $heroes = [];

        if(count($heroes_list)>0){
            foreach ($heroes_list as $hero){
                $ejercito = $hero->getEjercito();
                if ($ejercito->getId() == $id) {
                    $heroes[] = $this->unit_model($hero);
                }
            }
        }
        return new JsonResponse($heroes, Response::HTTP_OK);
    }

    public function get_basics (EntityManagerInterface $manager, int $id): Response{

        $bascis_list = $manager ->getRepository(Unidades::class) -> findBy(['categoria' => 'Básica']);
        $bascis = [];

        if(count($bascis_list)>0){
            foreach ($bascis_list as $basic){
                $ejercito = $basic->getEjercito();
                if ($ejercito->getId() == $id) {
                    $bascis[] = $this->unit_model($basic);
                }
            }
        }
        return new JsonResponse($bascis, Response::HTTP_OK);
    }

    public function get_especials (EntityManagerInterface $manager, int $id): Response{

        $specials_list = $manager ->getRepository(Unidades::class) -> findBy(['categoria' => 'Especial']);
        $specials = [];

        if(count($specials_list)>0){
            foreach ($specials_list as $special){
                $ejercito = $special->getEjercito();
                if ($ejercito->getId() == $id) {
                    $specials[] = $this->unit_model($special);
                }
            }
        }
        return new JsonResponse($specials, Response::HTTP_OK);
    }

    public function get_rares (EntityManagerInterface $manager, int $id): Response{

        $rares_list = $manager ->getRepository(Unidades::class) -> findBy(['categoria' => 'Singular']);
        $rares = [];

        if(count($rares_list)>0){
            foreach ($rares_list as $rare){
                $ejercito = $rare->getEjercito();
                if ($ejercito->getId() == $id) {
                    $rares[] = $this->unit_model($rare);
                }
            }
        }
        return new JsonResponse($rares, Response::HTTP_OK);
    }

    private function unit_model(Unidades $unit) {
        return [
            'id' => $unit -> getId(),
            'ejercito_id' => $unit -> getEjercito() -> getId(),
            'categoria' => $unit -> getCategoria(),
            'nombre' => $unit -> getNombre(),
            'tipo' => $unit -> getTipo(),
            'punto_mini' => $unit -> getPuntoMini(),
            'tamano_minimo' => $unit -> getTamanoMinimo(),
            'tamano_maximo' => $unit -> getTamanoMaximo()
        ]; 
    }

}
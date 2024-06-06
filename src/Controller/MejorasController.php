<?php
namespace App\Controller;

use App\Entity\Mejoras;
use App\Entity\Unidades;
use App\Entity\UnidadesYMejoras;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MejorasController extends AbstractController{

    public function get_upgradesUnit (EntityManagerInterface $manager,$unitId): Response{

        $unit =  $manager ->getRepository(Unidades::class) -> find($unitId);
        $upgradesList = $manager ->getRepository(UnidadesYMejoras::class) -> findBy(['id_unidad' => $unit]);
        
        $upgrades = [];

        if(count($upgradesList)>0){
            foreach ($upgradesList as $upgrade){
                $upgrades[] = [
                    'id' => $upgrade->getIdmejora() -> getId(),
                    'descripcion' => $upgrade->getIdmejora() -> getDescripcion(),
                    'nombre' => $upgrade->getIdmejora() -> getNombre(),
                    'rango' => $upgrade ->getIdmejora()-> getRango(),
                    'fuerza' => $upgrade ->getIdmejora()-> getFuerza(),
                    'penetracion' => $upgrade->getIdmejora() -> getPenetracion(),
                    'puntos' => $upgrade -> getPuntos()
                ];
            }
        }
        return new JsonResponse($upgrades, Response::HTTP_OK);
    }

    public function getHandWeapon(EntityManagerInterface $manager,$unitId): response{

        $unit =  $manager ->getRepository(Unidades::class) -> find($unitId);
        $upgradesList = $manager ->getRepository(UnidadesYMejoras::class) -> findBy(['id_unidad' => $unit]);
        
        $upgrades = null;

        if(count($upgradesList)>0){
            foreach ($upgradesList as $upgrade){
                if ($upgrade->getIdmejora() -> getId() == 1){
                    $upgrades = [
                        'id' => $upgrade->getIdmejora() -> getId(),
                        'descripcion' => $upgrade->getIdmejora() -> getDescripcion(),
                        'nombre' => $upgrade->getIdmejora() -> getNombre(),
                        'rango' => $upgrade ->getIdmejora()-> getRango(),
                        'fuerza' => $upgrade ->getIdmejora()-> getFuerza(),
                        'penetracion' => $upgrade->getIdmejora() -> getPenetracion(),
                        'puntos' => $upgrade -> getPuntos()
                    ];
                }
                
            }
        }
        return new JsonResponse($upgrades, Response::HTTP_OK);
    }
}
?>
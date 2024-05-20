<?php
namespace App\Controller;

use App\Entity\Atributos;
use App\Entity\Unidades;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AtributosController extends AbstractController{
}

    /**
     * @Route("/", methods={"GET"}, name="mostrarAtributos")
     */
    /*public function attribute_list (EntityManagerInterface $manager): Response{

        $attribute_list = $manager ->getRepository(Atributos::class) -> findAll();
        $attributes = [];

        if(count($attribute_list)>0){
            foreach ($attribute_list as $attribute){
                $attributes[] = [
                    'M' => $attribute -> getMovimiento(),
                    'HA' => $attribute -> getHabilidadArmas(),
                    'HP' => $attribute -> getHabilidadProyectil(),
                    'F' => $attribute -> getFuerza(),
                    'R' => $attribute -> getResistencia(),
                    'H' => $attribute -> getHeridas(),
                    'I' => $attribute -> getIniciativa(),
                    'A' => $attribute -> getAtaques(),
                    'L' => $attribute -> getLiderazgo()
                ];
            }
        }
        return new JsonResponse($attributes, Response::HTTP_OK);
    }


    /**
     * @Route("/", methods={"POST"}, name="anadirAtributos")
     */
    /*public function add_attribute ($id,EntityManagerInterface $manager, Request $peticion):Response{

        $data = json_decode($peticion->getContent(), true);
        

        if ($this->checkIfExists($data['idUnidad'],$manager)){

            $attribute = new Atributos();
            
            $attribute->setMovimiento($data['movimiento']);
            $attribute->setHabilidadArmas($data['habilidad_armas']);
            $attribute->setHabilidadProyectil($data['habilidad_proyectil']);
            $attribute->setFuerza($data['fuerza']);
            $attribute->setResistencia($data['resistencia']);
            $attribute->setHeridas($data['heridas']);
            $attribute->setIniciativa($data['iniciativa']);
            $attribute->setAtaques($data['ataques']);
            $attribute->setLiderazgo($data['liderazgo']);
            $attribute = $manager->getRepository(Unidades::class)->find($id);
            $attribute->setIdUnidad($data['idUnidad']);
            
     
            $manager->persist($attribute);
            $manager->flush();

            return new Response('', Response::HTTP_CREATED);
        }
        return new Response('', Response::HTTP_BAD_REQUEST);
    }


    public function checkIfExists($idUnidad,EntityManagerInterface $manager){
        $query = $manager->createQuery("SELECT c.id FROM App\Entity\Atributos c where (c.id_unidad_id=:idUnidad)");
        $query->setParameter('idUnidad', $idUnidad);
        $checking = $query->getScalarResult();
        if(sizeof($checking) !=0){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @Route("/{id}", methods={"DELETE"}, name="borrarAtributos")
     */
    /*public function delete_attributes($id, EntityManagerInterface $manager): Response {
        
        $attribute = $manager->getRepository(Atributos::class)->findOneBy(["id"=>$id]);

        if (!$attribute) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        $manager->remove($attribute);
        $manager->flush();

        return new Response('', Response::HTTP_OK);
    }

    /**
     * @Route("/{id}", methods={"PUT"}, name="editarAtributos")
     */
    /*public function modify_attributes($id, Request $request, EntityManagerInterface $manager): Response{*/

        /*$data = json_decode($request->getContent(), true);
        $attribute = $manager->getRepository(Atributos::class)->find($id);

        if (!$attribute) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        }

        if (!$this->checkIfExists($data['id_unidad_id'],$manager)){
            return new JsonResponse('', Response::HTTP_BAD_REQUEST);
        }

        $attribute->setIdUnidad($data['id_unidad_id']);
        $attribute->setMovimiento($data['movimiento']);
        $attribute->setHabilidadArmas($data['habilidad_armas']);
        $attribute->setHabilidadProyectil($data['habilidad_proyectil']);
        $attribute->setFuerza($data['fuerza']);
        $attribute->setResistencia($data['resistencia']);
        $attribute->setHeridas($data['heridas']);
        $attribute->setIniciativa($data['iniciativa']);
        $attribute->setAtaques($data['ataques']);
        $attribute->setLiderazgo($data['liderazgo']);
        $manager->flush();
        return new Response('', Response::HTTP_OK);
    }
}
?>*/
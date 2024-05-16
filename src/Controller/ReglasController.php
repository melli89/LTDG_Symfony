<?php
namespace App\Controller;

use App\Entity\ReglasEspeciales;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReglasController extends AbstractController{

    public function rules_list (EntityManagerInterface $manager): Response{

        $rules_list = $manager ->getRepository(ReglasEspeciales::class) -> findAll();
        $rules = [];

        if(count($rules_list)>0){
            foreach ($rules_list as $rule){
                $rules[] = [
                    'id' => $rule -> getId(),
                    'nombre' => $rule -> getNombre(),
                    'descripcion' => $rule -> getDescripcion()
                ];
            }
        }
        return new JsonResponse($rules, Response::HTTP_OK);
    }

    /**
     * @Route("/", methods={"GET"}, name="mostrarRegla")
     */
    public function seek_rule (EntityManagerInterface $manager, $nombre):Response{
        $show_rule = $manager -> getRepository(ReglasEspeciales::class) -> findOneBy(["nombre"=>$nombre]);

        if (!$show_rule){
            return new JsonResponse("", Response::HTTP_BAD_REQUEST);
        }

        $rule = [
            'id' => $show_rule -> getId(),
            'nombre' => $show_rule -> getNombre(),
            'descripcion' => $show_rule -> getDescripcion(),
        ];
        return new JsonResponse($rule, Response::HTTP_OK);
    }
    /**
     * @Route("/", methods={"POST"}, name="anadir")
     */
    public function add_rule (EntityManagerInterface $manager, Request $peticion):Response{

        $data = json_decode($peticion->getContent(), true);
        

        if ($this->checkName($data['nombre']) && $this->checkIfExists($data['nombre'],$manager)){

            $rule = new ReglasEspeciales();
            $rule->setNombre($data['nombre']);
            $rule->setDescripcion($data['descripcion']);
     
            $manager->persist($rule);
            $manager->flush();

            return new Response('', Response::HTTP_CREATED);
        }
        return new Response('', Response::HTTP_BAD_REQUEST);
    }

    public function checkName($name){
        if(strlen($name) != 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function checkIfExists($nombre,EntityManagerInterface $manager){
        $query = $manager->createQuery("SELECT c.id FROM App\Entity\ReglasEspeciales c where (c.nombre=:nombre)");
        $query->setParameter('nombre', $nombre);
        $checking = $query->getScalarResult();
        if(sizeof($checking) !=0){
            return false;
        }else{
            return true;
        }
    }


    public function delete_rule($nombre, EntityManagerInterface $manager): Response {
        
        $rule = $manager->getRepository(ReglasEspeciales::class)->findOneBy(["nombre"=>$nombre]);

        if (!$rule) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        $manager->remove($rule);
        $manager->flush();

        return new Response('', Response::HTTP_OK);
    }

    /**
     * @Route("/{id}", methods={"PUT"}, name="editar")
     */
    public function modify_rule($id, Request $request, EntityManagerInterface $manager): Response{

        $data = json_decode($request->getContent(), true);
        $rule = $manager->getRepository(ReglasEspeciales::class)->find($id);

        if (!$rule) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        }

        if (!$this->checkName($data['nombre'])  && !$this->checkIfExists($data['nombre'],$manager)){
            return new JsonResponse('', Response::HTTP_BAD_REQUEST);
        }

        $rule->setNombre($data['nombre']);
        $rule->setDescripcion($data['descripcion']);
        $manager->flush();
        return new Response('', Response::HTTP_OK);
    }
}
?>
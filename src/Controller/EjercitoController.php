<?php
namespace App\Controller;

use App\Entity\Ejercito;
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
class EjercitoController extends AbstractController{

    public function armies_list (EntityManagerInterface $manager): Response{

        $armies_list = $manager ->getRepository(Ejercito::class) -> findAll();
        $armies = [];

        if(count($armies_list)>0){
            foreach ($armies_list as $army){
                $armies[] = [
                    'id' => $army -> getId(),
                    'raza' => $army -> getRaza(),
                    'imagen' => $this->createImg($army -> getImagen())
                ]; 
            }
        }
        return new JsonResponse($armies, Response::HTTP_OK);
    }

    private function createImg($armieImg): string{
        return 'data:image/jpeg;base64,'.base64_encode(stream_get_contents($armieImg));
    }

    public function seek_army (EntityManagerInterface $manager, $id):JsonResponse{
        $show_army = $manager -> getRepository(Ejercito::class) -> find($id);

        if (!$show_army){
            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        }

        $army = [
            'id' => $show_army -> getId(),
            'raza' => $show_army -> getRaza(),
            'imagen' => $this->createImg($show_army -> getImagen())
        ];

        return new JsonResponse($army, Response::HTTP_OK);
    }

    /**
     * @Route("/", methods={"POST"}, name="anadir")
     */
    public function add_army (EntityManagerInterface $manager, Request $peticion):Response{

        $data = json_decode($peticion->getContent(), true);
        

        if ($this->checkName($data['raza']) && $this->checkIfExists($data['raza'],$manager)){

            $army = new Ejercito();
            $army->setRaza($data['raza']);
     
            $manager->persist($army);
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

    public function checkIfExists($raze,EntityManagerInterface $manager){
        $query = $manager->createQuery("SELECT c.id FROM App\Entity\Ejercito c where (c.raza=:raza)");
        $query->setParameter('raza', $raze);
        $checking = $query->getScalarResult();
        if(sizeof($checking) !=0){
            return false;
        }else{
            return true;
        }
    }


    public function delete_army($raza, EntityManagerInterface $manager): Response {
        
        $army = $manager->getRepository(Ejercito::class)->findOneBy(["raza"=>$raza]);

        if (!$army) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        $manager->remove($army);
        $manager->flush();

        return new Response('', Response::HTTP_OK);
    }

    /**
     * @Route("/{id}", methods={"PUT"}, name="editar")
     */
    public function modify_army($id, Request $request, EntityManagerInterface $manager): Response{

        $data = json_decode($request->getContent(), true);
        $army = $manager->getRepository(Ejercito::class)->find($id);

        if (!$army) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        }

        if (!$this->checkName($data['raza'])  && !$this->checkIfExists($data['raza'],$manager)){
            return new JsonResponse('', Response::HTTP_BAD_REQUEST);
        }

        $army->setRaza($data['raza']);
        $manager->flush();
        return new Response('', Response::HTTP_OK);
    }
}
?>
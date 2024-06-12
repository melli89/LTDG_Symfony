<?php
namespace App\Controller;

use App\Entity\Campeon;
use App\Entity\Ejercito;
use App\Entity\Listas;
use App\Entity\Mejoras;
use App\Entity\Unidades;
use App\Entity\UnidadUsuario;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ListasController extends AbstractController{

    /**
     * @Route("/listas", methods={"GET"}, name="get_listas")
     */
    public function getListas (EntityManagerInterface $manager): Response{

        $all_listas = $manager ->getRepository(Listas::class) -> findAll();
        $listas = [];

        if(count($all_listas)>0){
            foreach ($all_listas as $lista){
                $listas[] = $this->getListaModelo($lista);
            }
        }
        return new JsonResponse($listas, Response::HTTP_OK);
    }

    private function getListaModelo($lista) {
        return  [
            'id' => $lista -> getId(),
            'nombre_lista' => $lista -> getNombreLista(),
            'puntos_partida' => $lista -> getPuntosPartida(),
            'user' => $lista -> getUser() -> getId(),
            'ejercito' => $lista -> getEjercito() -> getRaza(),
            'unidades' => $this->getUnidades($lista -> getUnidades())
        ]; 
    }

    private function getUnidades($listaUnidades) {
        $unidades = [];
        foreach ($listaUnidades as $unidad) {
            $champion = null;
            if ($unidad -> getChampion()) {
                $champion = [
                    'id' => $unidad -> getChampion() -> getId(),
                    'puntos' => $unidad -> getChampion() -> getPuntos(),
                    'puntosOM' => $unidad -> getChampion() -> getPuntosOM(),
                    'nombre' => $unidad -> getChampion() -> getNombre(),
                ];
            }

            $unidades[] = [
                "id" => $unidad -> getId(),
                "minisAmount" => $unidad -> getMinisAmount(),
                "totalPoints" => $unidad -> getTotalPoints(),
                "model" => [
                    "id" => $unidad -> getModel()->getId(),
                    "ejercito_id" => $unidad -> getModel()->getEjercito()->getId(),
                    "categoria" => $unidad -> getModel()->getCategoria(),
                    "nombre" => $unidad -> getModel()->getNombre(),
                    "tipo" => $unidad -> getModel()->getTipo(),
                    "punto_mini" => $unidad -> getModel()->getPuntoMini(),
                    "tamano_minimo" => $unidad -> getModel()->getTamanoMinimo(),
                    "tamano_maximo" => $unidad -> getModel()->getTamanoMaximo(),
                ],
                "champion" => $champion,
                "upgrade" => [
                    "id" => $unidad -> getUpgrade() -> getId(),
                    "descripcion" => $unidad -> getUpgrade() -> getDescripcion(),
                    "nombre" => $unidad -> getUpgrade() -> getNombre(),
                ]
            ];
        }

        return $unidades;
    }

    /**
     * @Route("/listas/{id}", methods={"GET"}, name="get_lista")
     */
    public function seek_list (EntityManagerInterface $manager, $id):Response{
        $lista = $manager -> getRepository(Listas::class) -> find($id);

        if (!$lista){
            return new JsonResponse("", Response::HTTP_BAD_REQUEST);
        }

        $lista = $this->getListaModelo($lista);

        return new JsonResponse($lista, Response::HTTP_OK);
    }

    /**
     * @Route("/listas/user/{id}", methods={"GET"}, name="get_user_lista")
     */
    public function seek_user_list (EntityManagerInterface $manager, $userId):Response{
        $user = $manager -> getRepository(User::class) -> find($userId);

        if (!$user){
            return new JsonResponse("", Response::HTTP_BAD_REQUEST);
        }

        $listas = $manager -> getRepository(Listas::class) -> findBy(['user' => $user]);

        if (count($listas) < 1) {
            return new JsonResponse("", Response::HTTP_BAD_REQUEST);
        }

        $modelos = [];
        foreach($listas as $lista) {
            $modelos[] = $this->getListaModelo($lista);
        }

        return new JsonResponse($modelos, Response::HTTP_OK);
    }

    /**
     * @Route("/listas", methods={"POST"}, name="add_lista")
     */
    public function add_list (EntityManagerInterface $manager, Request $peticion):Response{

        $data = json_decode($peticion->getContent(), true);
        
        $lista = new Listas();
        $lista -> setNombreLista($data['nombre_lista']);
        $lista -> setPuntosPartida($data['puntos_partida']);

        $user = $manager -> getRepository(User::class) -> find($data['user']);
        $ejercito = $manager -> getRepository(Ejercito::class) -> find($data['ejercito']);

        if(!$user || !$ejercito) {
            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        }

        $lista -> setUser($user);
        $lista -> setEjercito($ejercito);

        foreach ($data["unidades"] as $unidad) {
            $unidadUsuario = new UnidadUsuario();
            $unidadUsuario -> setMinisAmount($unidad["minisAmount"]);
            $unidadUsuario -> setTotalPoints($unidad['totalPoints']);

            $model = $unidad["model"];
            $champion = $unidad["champion"];
            $upgrade = $unidad["upgrade"];

            $model = $manager -> getRepository(Unidades::class) -> find($model['id']);

            if ($champion) {
                $champion = $manager -> getRepository(Campeon::class) -> find($champion['id']);
            }

            if ($upgrade) {
                $upgrade = $manager -> getRepository(Mejoras::class) -> find($upgrade['id']);
            }

            if (!$model) {
                return new JsonResponse([], Response::HTTP_BAD_REQUEST);
            }

            $unidadUsuario -> setModel($model);
            $unidadUsuario -> setChampion($champion);
            $unidadUsuario -> setUpgrade($upgrade);

            $manager->persist($unidadUsuario);

            $lista -> addUnidades($unidadUsuario);
        }

        $manager->persist($lista);
        $manager->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/listas/{id}", methods={"DELETE"}, name="delete_lista")
     */
    public function delete_list($id, EntityManagerInterface $manager): Response {
        
        $lista = $manager->getRepository(Listas::class)->find($id);

        if (!$lista) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        $manager->remove($lista);
        $manager->flush();

        return new Response('', Response::HTTP_OK);
    }

    /**
     * @Route("/listas/{id}", methods={"PUT"}, name="modify_listas")
     */
    public function modify_list (EntityManagerInterface $manager, Request $peticion, $id):Response{

        $data = json_decode($peticion->getContent(), true);
        
        $lista =  $manager -> getRepository(Listas::class) -> find($id);;
        $lista -> setNombreLista($data['nombre_lista']);
        $lista -> setPuntosPartida($data['puntos_partida']);

        $user = $manager -> getRepository(User::class) -> find($data['user']);
        $ejercito = $manager -> getRepository(Ejercito::class) -> find($data['ejercito']['id']);

        if(!$user || !$ejercito) {
            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        }

        $lista -> setUser($user);
        $lista -> setEjercito($ejercito);

        foreach(($lista -> getUnidades()) as $unidad) {
            $lista->removeUnidades($unidad);
        }

        foreach ($data["unidades"] as $unidad) {
            $unidadUsuario = new UnidadUsuario();
            $unidadUsuario -> setMinisAmount($unidad["minisAmount"]);
            $unidadUsuario -> setTotalPoints($unidad['totalPoints']);

            $model = $unidad["model"];
            $champion = $unidad["champion"];
            $upgrade = $unidad["upgrade"];

            $model = $manager -> getRepository(Unidades::class) -> find($model);
            $champion = $manager -> getRepository(Campeon::class) -> find($champion);
            $upgrade = $manager -> getRepository(Mejoras::class) -> find($upgrade);

            if (!$model) {
                return new JsonResponse([], Response::HTTP_BAD_REQUEST);
            }

            $unidadUsuario -> setModel($model);
            $unidadUsuario -> setChampion($champion);
            $unidadUsuario -> setUpgrade($upgrade);

            $manager->persist($unidadUsuario);

            $lista -> addUnidades($unidadUsuario);
        }

        $manager->persist($lista);
        $manager->flush();

        return new Response('', Response::HTTP_CREATED);
    }
}
?>
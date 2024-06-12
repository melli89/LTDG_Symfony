<?php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


//Se debe de crear un entity manager que sirve como objeto que realiza las peticiones a la base de datos (doctrine).
    /**
     * @Route("/", methods={"GET"}, name="mostrarUsuarios")
     */
class UserController extends AbstractController{

    public function users_display (EntityManagerInterface $manager): Response{

        $user_list = $manager ->getRepository(User::class) -> findAll();
        $users = [];

        if(count($user_list)>0){
            foreach ($user_list as $user){
                $users[] = [
                    'id' => $user -> getId(),
                    'email' => $user -> getEmail(),
                    'roles' => $user -> getRoles()
                ];
            }
        }
        return new JsonResponse($users, Response::HTTP_OK);
    }

    public function seek_user (EntityManagerInterface $manager, $id):Response{
        $show_user = $manager -> getRepository(User::class) -> find($id);

        if (!$show_user){
            return new JsonResponse("", Response::HTTP_BAD_REQUEST);
        }

        $user = [
            'id' => $show_user -> getId(),
            'email' => $show_user -> getEmail(),
            'roles' => $show_user -> getRoles()
        ];
        return new JsonResponse($user, Response::HTTP_OK);
    }

    /**
     * @Route("/users", methods={"POST"}, name="anadirUsuario")
     */
    public function add_user (UserPasswordHasherInterface $passwordHasher,EntityManagerInterface $manager, Request $peticion):Response{

        $data = json_decode($peticion->getContent(), true);
        

        if ($this->checkName($data['email']) && $this->checkIfExists($data['email'],$manager, null)){

            $user = new User();
            $user->setEmail($data['email']);
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $data['password']
            );
            $user->setPassword($hashedPassword);
     
            $manager->persist($user);
            $manager->flush();$manager->persist($user);
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

    public function checkIfExists($email,EntityManagerInterface $manager, $id){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     
            return false;
        }
        
        $user = $manager->getRepository(User::class)->findOneBy(["email"=>$email]);

        if($user){
            if ($id && $user->getId() == $id) {
               
                return true;
            }
     
            return false;
            
        }else{
        
            return true;
        }
    }


    public function delete_user($id, EntityManagerInterface $manager): Response {
        
        $user = $manager->getRepository(User::class)->find($id);

        if (!$id) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }else{
            $manager->remove($user);
            $manager->flush();
        }

        return new Response('', Response::HTTP_OK);
    }

    /**
     * @Route("/{email}", methods={"PUT"}, name="editarUsuario")
     */
    public function modify_user(UserPasswordHasherInterface $passwordHasher,$id, Request $request, EntityManagerInterface $manager): Response{

        $data = json_decode($request->getContent(), true);
        $user = $manager->getRepository(User::class)->find($id);

        if (!$user) {
            return new JsonResponse(['error'=>'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }else if ($this->checkIfExists($data['email'],$manager,$id)){
            $user->setEmail($data['email']);

            if ($data['password']) {
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $data['password']
                );
                $user->setPassword($hashedPassword);
            }

            $manager->flush();
            return new JsonResponse([], Response::HTTP_OK);
        }

        return new JsonResponse(['error'=>'Error al modificar el usuario'], Response::HTTP_BAD_REQUEST);
    }

    public function logIn(JWTTokenManagerInterface $JWTManager,UserPasswordHasherInterface $passwordHasher,Request $request, EntityManagerInterface $manager){
        $data = json_decode($request->getContent(), true);
        $user = $manager->getRepository(User::class)->findOneBy(["email"=>$data['email']]);
        if(!$user){
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }
        if (!$passwordHasher->isPasswordValid($user, $data['password'])) {
            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        }

        $token = $JWTManager->create($user);
        return new JsonResponse(['token' => $token], Response::HTTP_OK);
    }
}
?>
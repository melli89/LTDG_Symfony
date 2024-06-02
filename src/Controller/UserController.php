<?php
namespace App\Controller;

use App\Entity\Ejercito;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
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

    public function seek_user (EntityManagerInterface $manager, $email):Response{
        $show_user = $manager -> getRepository(User::class) -> findOneBy(["email"=>$email]);

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
        

        if ($this->checkName($data['email']) && $this->checkIfExists($data['email'],$manager)){

            $user = new User();
            $user->setEmail($data['email']);
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $data['password']
            );
            $user->setPassword($hashedPassword);
     
            $manager->persist($user);
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

    public function checkIfExists($email,EntityManagerInterface $manager){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        $query = $manager->createQuery("SELECT c.id FROM App\Entity\User c where (c.email=:email)");
        $query->setParameter('email', $email);
        $checking = $query->getScalarResult();
    
        if(sizeof($checking) !=0){
            return false;
        }else{
            return true;
        }
    }


    public function delete_user($email, EntityManagerInterface $manager): Response {
        
        $user = $manager->getRepository(User::class)->findOneBy(["email"=>$email]);

        if (!$email) {
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
    public function modify_user(UserPasswordHasherInterface $passwordHasher,$email, Request $request, EntityManagerInterface $manager): Response{

        $data = json_decode($request->getContent(), true);
        $user = $manager->getRepository(User::class)->findOneBy(["email"=>$email]);

        if (!$user) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        }else if (!$this->checkName($email['email'])  && !$this->checkIfExists($data['email'],$manager)){
            return new JsonResponse('', Response::HTTP_BAD_REQUEST);
        }

        $user->setEmail($data['email']);
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $data['password']
        );
        $user->setPassword($hashedPassword);
        $manager->flush();
        return new Response('', Response::HTTP_OK);
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
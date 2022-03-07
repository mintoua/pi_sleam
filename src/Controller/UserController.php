<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class UserController extends AbstractController
{
    /**
     * @Route("/users", name="user_list")
     */
    public function index()
    {
        $read = $this->getDoctrine()->getRepository(User::class);
        $users = $read->findAll();


        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }


}

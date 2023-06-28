<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UserController extends Controller
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function register(Request $request,
                             UserPasswordEncoderInterface $passwordEncoder,
                             EntityManagerInterface $em)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $em->persist($user);
            $em->flush();

            $this->addFlash("success", "Votre compte a bien été créé !");
            return $this->redirectToRoute("app_login");
        }

        return $this->render("client/inscription.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();


    if(TRUE === $this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
        return $this->redirectToRoute('home');
    }
        return $this->render('client/connexion.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){}
}

<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserRegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    /**
     * @Route("/register")
     * @Template("user/register.html.twig")
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserRegistrationType::class, $user, [
            'attr' => [
                'novalidate' => true,
            ]
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->get('fos_user.user_manager')->updateUser($user);

            return $this->redirectToRoute('app_default_index');
        }

        return [
            'form' => $form->createView()
        ];
    }
}
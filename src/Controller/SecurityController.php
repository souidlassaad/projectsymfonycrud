<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\RegistryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class SecurityController extends AbstractController
{
    #[Route('/register', name: 'app_register')]

    public function registration(Request $request, EntityManagerInterface  $em, 
       )
    {
        $user = new User();
        $form  = $this->createForm(RegistryType::class, $user);
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
           // $hash = $encoder->encodePassword($user,$user->getPassword());
            //$user->setPassword($hash);
        //l'objet $em sera affecté automatiquement grâce à l'injection des dépendances de symfony 4  
           $em->persist($user);
           $em->flush();  
           return $this->redirectToRoute('app_register');
        }
       return $this->render('security/registration.html.twig', 
                           ['form' =>$form->createView()]);
    }


   

}


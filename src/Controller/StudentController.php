<?php

namespace App\Controller;
use App\Entity\Student;
use App\Entity\Search;
use App\Form\StudentType;
use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/', name: 'app_student')]
    public function index(PersistenceManagerRegistry $doctrine,Request $request): Response
    {
      //$data = $doctrine->getRepository(Student::class)->findAll();
      $propertySearch = new Search(); 
      $form = $this->createForm(SearchType::class,$propertySearch); 
      $form->handleRequest($request); 
      $data= [];
      if($form->isSubmitted() && $form->isValid()) {
        $cin = $propertySearch->getCin(); 
        if ($cin!="") 
        $data= $doctrine->getRepository(Student::class)->findBy(['cin' => $cin] ); 
        else
        $data= $doctrine->getRepository(Student::class)->findAll();
       }
       return $this->render('student/index.html.twig',[ 
        'form' => $form->createView(),
        'list' => $data,
    ]);
        }
       
        
    

    #[Route('/create', name: 'create')]
    public function Create(Request $request ,PersistenceManagerRegistry $doctrine){
      $student = new Student();
      $form = $this->createForm(StudentType::class,$student);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form ->isValid()){
        $em = $doctrine->getManager();
        $em->persist($student);
        $em->flush();
        $this->addFlash('notice','create successfully');
        return $this->redirectToRoute('app_student');
      }
      return $this->render('student/create.html.twig',[
        'form' => $form->createView()
      ]);
    }

    #[Route('/update/{id}', name: 'update')]
    public function update(Request $request,$id,PersistenceManagerRegistry $doctrine){
        $student = $doctrine->getRepository(Student::class)->find($id) ;
        $form = $this->createForm(StudentType::class,$student);
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form ->isValid()){
          $em = $doctrine->getManager();
          $em->persist($student);
          $em->flush();
          $this->addFlash('notice','update successfully');
          return $this->redirectToRoute('app_student');
        }
        return $this->render('student/update.html.twig',[
          'form' => $form->createView()
        ]);
    }


    #[Route('/delete/{id}', name: 'delete')]
    public function delete($id,PersistenceManagerRegistry $doctrine){
        $data = $doctrine->getRepository(Student::class)->find($id);
        $em = $doctrine->getManager();
        $em->remove($data);
        $em->flush();
        $this->addFlash('notice','delete successfully');
        return $this->redirectToRoute('app_student');
    } 

}

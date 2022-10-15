<?php

namespace App\Controller;

use App\Entity\Student;

use App\Form\AddStudentType;

use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use App\Form\ArticleType;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    /********************list Student**********************/
    #[Route ('/listStudent',name:'listStudent')]
    public function listStudent(StudentRepository $repo): Response
    {
        $students = $repo->findAll();
        return $this->render('student/listStudent.html.twig', [
            'students' => $students,
        ]);
    }

    #[Route('/listStudent2',name: 'listStudent2')]
    public function listStudent2(ManagerRegistry $doctrine): Response
    {
        $students = $doctrine->getRepository(Student::class)->findAll();
        return $this->render('Student/listStudent.html.twig', [
            'students' => $students,
        ]);
    }
    /********************show Student**********************/
    #[Route('/showStudent/{num}',name:"studentDetails")]
    public function show(Student $student): response
    {
        return $this->render('student/showStudent.html.twig', [
            'student' => $student,
        ]);
    }
    #[Route('/showStudent1/{num}',name:"showStudent1")]
    public function show1(ManagerRegistry $doctrine, $num): Response
    {
        $student = $doctrine->getRepository(Student::class)->find($num);
        return $this->render('student/showStudent.html.twig', [
            'student' => $student,
        ]);
    }

    #[Route('/showStudent2/{num}',name:"showStudent2")]
    public function show2(StudentRepository $repo, $num): Response
    {
        $student = $repo->find($num);
        return $this->render('student/showStudent.html.twig', [
            'student' => $student,
        ]);
    }
    /********************delete Student**********************/
    #[Route('/delete/{num}', name: 'studentDelete')]
    public function delete(ManagerRegistry $doctrine, $num): Response
    {
        $student = $doctrine->getRepository(Student::class)->find($num);

        $entityManger = $doctrine->getManager();
        $entityManger->remove($student);
        $entityManger->flush();

        return new Response('Deleted');
    }

    #[Route('/delete1/{num}', name: 'studentDelete1')]
    public function delete1(StudentRepository $repo, $num): Response
    {
        $student = $repo->find($num);
        $repo->remove($student, true);
        return new Response('Deleted');
    }

    /*********************Add Student**********************/

    #[Route ('/addStudent',name:'studentAdd')]
    public function add(Request $request, StudentRepository $repo): Response
    {
        $student = new Student();
        // $student->setNom('Test');

        // $form = $this->createFormBuilder($student)
        //     ->add('nom', TextType::class)
        //     ->add('save', SubmitType::class)
        //     ->getForm();

        $form = $this->createForm(AddStudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $student = $form->getData();
            $repo->add($student, true);
            return $this->redirectToRoute('listStudent');
        }

        return $this->render('student/add.html.twig', [
            'form' => $form->createView(),
        ]);
        //renderForm mat3adetch !!!!
        //return $this->renderForm('student/add.html.twig', [ 'form' => $form]);
    }
}

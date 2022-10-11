<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    #[Route ('/listStudent',name:'listStudent')]
    public function listStudent(StudentRepository $repo):Response{
        $students=$repo->findAll();
        return $this->render('student/listStudent.html.twig',['students'=>$students]);
    }
    
    #[Route('/showStudent/{num}',name:"studentDetails")]
    public function show3(Student $student):response{
        return $this->render('student/showStudent.html.twig',['student'=>$student]);
    }
}


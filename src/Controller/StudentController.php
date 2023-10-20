<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class StudentController extends AbstractController
{
    /**
     * @Route('/Student', name='app_index')
     */
    public function index(): Response {
        return new Response('Bonjour Jamila');
    }
    /**
     * @Route('/Student/show/{name}', name='show_teacher')
     */
    public function showTeacher($name): Response {
        return new Response("Bonjour $name");
    }
}
?>
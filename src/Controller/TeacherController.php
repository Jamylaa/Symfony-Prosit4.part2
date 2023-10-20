<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class TeacherController extends AbstractController
{
    /**
     * @Route('/Teacher/show/{name}', name='show_teacher')
     */
    public function showTeacher($name): Response {
        return new Response("Bonjour $name");
    }
    /**
     * @Route("/Teacher/goToIndex", name="app_teacher_go_to_index")
     */
    public function goToIndex(): Response {
        // Générer l'URL de l'action index du contrôleur StudentController
        $studentControllerUrl = $this->generateUrl('app_student_index'); // Remplacez 'app_student_index' par le nom de votre route StudentController index
        return new RedirectResponse($studentControllerUrl);
    }
}
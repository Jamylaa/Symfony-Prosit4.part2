<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author/{name}", name="app_show")
     */

    public function showAuthor($name): Response
    {
        return $this->render('author/show.html.twig', [
            'controller_Jamila' => $name,
        ]);
    }
    #[Route('/author/get/all',name:'app_get_all')]
        public function getAll(AuthorRepository $repo){
        $authors = $repo->findAll();
        return $this->render('author/Listauthors.html.twig',[
            'a'=>$authors
        ]);
        }
        #[Route('/author/add',name:'app_add_author')]
        public function add(ManagerRegistry $manager){
$author = new Author();
$author->setUsernamer('author 1');
$author->setEmail('author@esprit.tn');
$author->getManager()->persist($author);
$author->getManager()->flush();
return $this->redirectToRoute('app_get_all_author');
        }
        #[Route('/author/delete', name:'app_delete_author')]
        public function delete($id,ManagerRegistry $manager,AuthorRepository $repo){
$author = $repo->find($id);
$manager->getManager()->remove($author);
$manager->getManager()->flush();
return $this ->redirectToRoute('app_get_all_author');

    }
        /**
     * @Route("/author/show/list", name="app_list_show")
     */
    public function list(): Response
    {
        $authors = array(
        array('id' => 1, 'picture' => 'https://shorturl.at/DJY39','username' => 'Nom d auteur : Victor Hugo',
        'email' => 'E-mail : victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => 'https://shorturl.at/iDO48','username' => '
            Nom d auteur : William Shakespeare', 'email' => 'E-mail :  william.shakespeare@gmail.com', 'nb_books' =>
            200 ),
            array('id' => 3, 'picture' => 'https://shorturl.at/azAT8','username' => 'Nom d auteur : Taha
            Hussein', 'email' => 'E-mail : taha.hussein@gmail.com', 'nb_books' => 300),);
        return $this->render('author/list.html.twig', [
        'List' =>  $authors,
        ]);
    }
/**
     * @Route("/author/{id}", name="app_author_details")
     */
    public function authorDetails($id):Response
    {
        return $this->render('showAuthor.html.twig', [
        
        ]);
    }
}
?>
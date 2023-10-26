<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class BookController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'JijiController',
        ]);
    }

    #[Route('/addbook', name: 'app_book_add')]
    public function addBook(Request $req,ManagerRegistry $manager){
        $book = new Book();
        $form =$this->createForm(BookType::class,$book);
        $form->handleRequest($req);
         //$book->setRef($form->getData()->getRef());
        if($form->isSubmitted()){
            $book->setPublished(true);
        $manager->getManager()->persist($book);
        $manager->getManager()->flush();
        return $this->redirectToRoute('app_book');
        }
        return $this->render('book/add.html.twig',[
            'f'=>$form->createView()
        ]);
    }

    #[Route('/affichebook', name: 'app_book_affiche')]
    public function affiche(EntityManagerInterface $entityManager){
        $publishedbooks = $this->entityManager
            ->getRepository(Book::class)
            ->findBy(['published' => true]);
        return $this->render('book/affiche.html.twig', [
            'Books' => $publishedbooks,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_book_delete')]
    public function delete(Book $book, EntityManagerInterface $entityManager): Response
    {
        // si le livre existe
        if (!$book) {
            throw $this->createNotFoundException('no Book');
        }

        $entityManager->remove($book);
        $entityManager->flush();
        return $this->render('book/delete.html.twig');
    }

    public function deleteAuthor(EntityManagerInterface $entityManager): Response
    {
        // Récupérez les auteurs
        $authorsToDelete = $entityManager
            ->getRepository(Author::class)
            ->findBy(['nb_books' => 0]);

        foreach ($authorsToDelete as $author) {
            // Supprimez chaque auteur
            $entityManager->remove($author);
        }

        // Exécutez
        $entityManager->flush();

        $this->addFlash('success', count($authorsToDelete) . 'Sucessefully deleted ');

        return $this->render('book/deleteAuthor.html.twig');
    }

    #[Route('/showbook', name: 'app_book_show')]
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }

}
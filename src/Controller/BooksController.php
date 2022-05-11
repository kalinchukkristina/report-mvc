<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BooksRepository;
use App\Entity\Books;

class BooksController extends AbstractController
{
    #[Route('/books', name: 'app_books')]
    public function index(): Response
    {
        return $this->render('books/index.html.twig', [
            'controller_name' => 'BooksController',
        ]);
    }

    /**
     * @Route("/books/create", name="create_book", methods={"GET","HEAD"})
     */
    public function createBook(): Response
    {
        return $this->render('books/create.html.twig');
    }

    /**
     * @Route("/books/create", name="create_book_handler", methods={"POST"})
     */
    public function createBookHandler(
        ManagerRegistry $doctrine,
        Request $request,
    ): Response {
        $entityManager = $doctrine->getManager();
        $submit = $request->request->get('submit');
        $title = $request->request->get('title');
        if ($submit && $title) {
            $isbn = $request->request->get('isbn');
            $author = $request->request->get('author');
            $picUrl = $request->request->get('picUrl');

            $book = new Books();
            $book->setTitle(htmlspecialchars($title));
            $book->setIsbn(htmlspecialchars($isbn));
            $book->setAuthor(htmlspecialchars($author));
            $book->setPic(htmlspecialchars($picUrl));

            // tell Doctrine you want to (eventually) save the book
            $entityManager->persist($book);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
                return $this->redirectToRoute('books_show_all');
        };

        return new Response('failed');
    }

    /**
    * @Route("/books/show", name="books_show_all")
    */
    public function showAllBooks(
        BooksRepository $BooksRepository
    ): Response {
        $books = $BooksRepository
            ->findAll();

        $data = [
            'books' => $books
        ];

        return $this->render('books/show.html.twig', $data);
    }

    /**
     * @Route("/books/show/{id}", name="book_by_id")
     */
    public function showbookById(
        BooksRepository $BooksRepository,
        int $id
    ): Response {
        $book = $BooksRepository
            ->find($id);

        $data = [
            'book' => $book
        ];

        return $this->render('books/showOne.html.twig', $data);
    }

    /**
     * @Route("/books/update/{id}", name="update_by_id")
     */
    public function updateBookById(
        BooksRepository $BooksRepository,
        int $id
    ): Response {
        $book = $BooksRepository
            ->find($id);

        $data = [
            'book' => $book
        ];

        return $this->render('books/update.html.twig', $data);
    }

    /**
     * @Route("/books/update", name="update_book_handler", methods={"POST"})
     */
    public function updateBookHandler(
        ManagerRegistry $doctrine,
        Request $request,
        BooksRepository $BooksRepository,
    ): Response {
        $entityManager = $doctrine->getManager();
        $submit = $request->request->get('submit');

        if ($submit) {
            $id = $request->request->get('id');
            $title = $request->request->get('title');
            $isbn = $request->request->get('isbn');
            $author = $request->request->get('author');
            $picUrl = $request->request->get('picUrl');

            $book = $BooksRepository
                ->find($id);
            $book->setTitle(htmlspecialchars($title));
            $book->setIsbn(htmlspecialchars($isbn));
            $book->setAuthor(htmlspecialchars($author));
            $book->setPic(htmlspecialchars($picUrl));

            $entityManager->persist($book);

            $entityManager->flush();
                return $this->redirectToRoute('books_show_all');
        };

        return new Response('failed');
    }

    /**
     * @Route("/books/delete/{id}", name="book_delete_by_id")
     */
    public function deleteBookById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Books::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id ' . $id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('books_show_all');
    }
}

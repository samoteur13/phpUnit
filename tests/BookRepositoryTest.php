<?php

namespace App\Tests;

use App\Entity\Book;
use App\Entity\Category;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BookRepositoryTest extends KernelTestCase
{
    public function testFindById()
    {
        $category = (new Category())->setName('Fiction');

        $book = (new Book($category))
          ->setTitle('Test Book')
          ->setAuthor('John Doe')
          ->setYear('1987');

        $entityManager = self::getContainer()
            ->get(EntityManagerInterface::class);

        $entityManager->persist($category);
        $entityManager->persist($book);
        $entityManager->flush();

        // Recherche le livre par son identifiant
        $foundBook = self::getContainer()
            ->get(BookRepository::class)
            ->find($book->getId());
            
        // Vérifie si le livre récupéré correspond au livre créé
        static::assertSame($book, $foundBook);
    }
}

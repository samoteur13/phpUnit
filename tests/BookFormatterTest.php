<?php

namespace App\Tests;

use App\Entity\Book;
use App\Entity\Category;
use App\Service\BookFormatter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BookFormatterTest extends KernelTestCase
{
    public function testFormatBookInfo()
    {
        // Récupère le service BookFormatter
        $bookFormatter = self::getContainer()->get(BookFormatter::class);
        // Crée un nouveau livre
        $category = (new Category())->setName('Fiction');
        $book = (new Book($category))
          ->setTitle('Test Book')
          ->setAuthor('John Doe');
        // Formate les informations du livre
        $formattedInfo = $bookFormatter->format($book);
        // Vérifie si les informations du livre sont correctement formatées
        static::assertEquals(
            'Fiction-Test-Book-by-John-Doe', 
            $formattedInfo
        );
    }
}

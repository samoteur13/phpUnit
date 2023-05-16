<?php

namespace App\Tests;

use App\Entity\Book;
use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function testGetCategoryName()
    {
        // Crée un mock de la classe Category
        $categoryMock = $this->createMock(Category::class);
        // Configure le mock pour retourner 'Fiction' lors de l'appel à la méthode 'getName'
        $categoryMock->method('getName')->willReturn('Fiction');
        // Utilise le mock de Category lors de la création de l'instance de Book
        $book = new Book($categoryMock);
        // Teste si la méthode 'getCategoryName' retourne le nom de la catégorie défini par le mock
        $this->assertEquals('Fiction', $book->getCategoryName());
    }
}

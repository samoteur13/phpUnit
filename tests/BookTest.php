<?php

namespace App\Tests;

use App\Entity\Book;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function testGetId()
    {
        $book = new Book();
        $book->setId(1);
        static::assertEquals(1, $book->getId());
    }
    public function testGetTitle()
    {
        $book = new Book();
        $book->setTitle('Le Petit Prince');
        static::assertEquals('Le Petit Prince', $book->getTitle());
    }
    public function testGetAuthor()
    {
        $book = new Book();
        $book->setAuthor('Antoine de Saint-Exupéry');
        static::assertEquals('Antoine de Saint-Exupéry', $book->getAuthor());
    }
}

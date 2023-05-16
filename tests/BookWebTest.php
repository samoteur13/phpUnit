<?php

namespace App\Tests;

use App\Entity\Book;
use App\Entity\Category;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookWebTest extends WebTestCase
{
    public function testNewBookForm()
    {
        $client = static::createClient();
        $category = new Category();
        $category->setName('Category 1');
        $entityManager = static::getContainer()->get(EntityManagerInterface::class);
        $entityManager->persist($category);
        $entityManager->flush();

        $crawler = $client->request('GET', '/book/new');

        $this->assertResponseIsSuccessful();
        
        $form = $crawler->selectButton('Save')->form();
        $form['book[title]'] = $title = 'Book 1';
        $form['book[author]'] = "Author";
        $form['book[year]'] = "2014";
        $form['book[category]'] = $category->getId();
         
        $client->submit($form);
        
        $this->assertResponseRedirects('/');
        
        $book = self::getContainer()
            ->get(BookRepository::class)
            ->findOneBy(['title' => $title]);

        self::assertInstanceOf(Book::class, $book);
        self::assertSame($title, $book->getTitle());
        self::assertSame($category->getName(), $book->getCategoryName());
    }
}
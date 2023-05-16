<?php

namespace App\Tests;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryTest extends WebTestCase
{
    public function testNewCategoryForm()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/category/new');
        $this->assertResponseIsSuccessful(); //response 200
        $form = $crawler->selectButton('Save')->form();
        $form['category[name]'] = $name = 'Category 1';
        $client->submit($form);
        $this->assertResponseRedirects('/');
        $category = self::getContainer()
            ->get(CategoryRepository::class)
            ->findOneBy(['name' => $name]);
        self::assertInstanceOf(Category::class, $category);
    }
}

<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;
class EndToEndTest extends PantherTestCase
{
    public function testNewCategoryForm()
    {
        $client = static::createPantherClient([
            'external_base_uri' => $_SERVER['SYMFONY_PROJECT_DEFAULT_ROUTE_URL']
        ]);
        $crawler = $client->request('GET', '/category/new');
        $this->assertResponseIsSuccessful();
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
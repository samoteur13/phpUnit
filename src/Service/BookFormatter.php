<?php

namespace App\Service;

use App\Entity\Book;
use Symfony\Component\String\Slugger\SluggerInterface;
final readonly class BookFormatter
{
    public function __construct(
        private SluggerInterface $slugger
    ) {       
    }
    public function format(Book $book): string
    {
        $text = sprintf(
            '(%s) %s by %s',
            $book->getCategoryName(),
            $book->getTitle(),
            $book->getAuthor()
        ); 

        return $this->slugger->slug($text);
    }
}
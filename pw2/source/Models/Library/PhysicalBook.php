<?php 

namespace Source\Models\Library;

use Source\Models\Library\Book;

class PhysicalBook extends Book {
    public int $copiesInStock;
    public String $shelfLocation;

    public function __construct(string $isbn, string $title, Author $author, int $publicationYear, int $pages, int $copiesInStock, String $shelfLocation) {
        parent::__construct($isbn, $title, $author, $publicationYear, $pages);
        $this->copiesInStock = $copiesInStock;
        $this->shelfLocation = $shelfLocation;
    }

    public function calculateLateFee(int $days): float {
        return 2.00;
    }

    public function show(): String {
        return "
        Livro Físico: {parent::getTitle()}
        ISBN: {parent::getIsbn()}
        Autor: {parent::getAuthor()->getName()}
        Ano de Publicação: {parent::publicationYear()}
        Páginas: {parent::pages}
        Exemplares em Estoque: {$this->copiesInStock}
        Localização: {$this->shelfLocation}
        ";
    }
}
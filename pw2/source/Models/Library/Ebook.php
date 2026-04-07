<?php

namespace Source\Models\Library;

use Source\Models\Library\Book;

class Ebook extends Book {
    public float $fileSizeMB;
    public String $format;

    public function __construct(string $isbn, string $title, Author $author, int $publicationYear, int $pages, float $fileSizeMB, String $format) {
        parent::__construct($isbn, $title, $author, $publicationYear, $pages);
        $this->fileSizeMB = $fileSizeMB;
        $this->format = $format;
    }

    public function calculateLateFee(int $days): float {
        return 0.50;
    }

    public function show(): String {
        return "
        Livro Físico: {parent::getTitle()}
        ISBN: {parent::getIsbn()}
        Autor: {parent::getAuthor()->getName()}
        Ano de Publicação: {parent::publicationYear()}
        Páginas: {parent::pages}
        Tamanho: {$this->fileSizeMB} MB
        Formato: {$this->format}
        ";
    }
}
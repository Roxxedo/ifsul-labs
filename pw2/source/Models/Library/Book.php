<?php

namespace Source\Models\Library;

use Source\Models\Library\Author;

abstract class Book {
    public String $isbn;
    public String $title;
    public Author $author;
    public int $publicationYear;
    public int $pages;

    public function __construct(String $isbn, String $title, Author $author, int $publicationYear, int $pages) {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->author = $author;
        $this->publicationYear = $publicationYear;
        $this->pages = $pages;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getPublicationYear() {
        return $this->publicationYear;
    }

    public function setPublicationYear($publicationYear) {
        $this->publicationYear = $publicationYear;
    }

    public function getPages() {
        return $this->pages;
    }

    public function setPages($pages) {
        $this->pages = $pages;
    }

    abstract function calculateLateFee(int $days): float;

    public function show(): String {
        return "
        Livro: {$this->title}
        ISBN: {$this->isbn}
        Autor: {$this->author}
        Ano de Publicação: {$this->publicationYear}
        Páginas: {$this->pages}
        ";
    }
}
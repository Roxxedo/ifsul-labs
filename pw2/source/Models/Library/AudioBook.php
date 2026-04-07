<?php

namespace Source\Models\Library;

use Source\Models\Library\Book;

class AudioBook extends Book {
    public int $durationMinutes;

    public function __construct(string $isbn, string $title, Author $author, int $publicationYear, int $pages, int $durationMinutes) {
        parent::__construct($isbn, $title, $author, $publicationYear, $pages);
        $this->durationMinutes = $durationMinutes;
    }

    public function calculateLateFee(int $days): float {
        return 1.0;
    }

    public function show(): String {
        $hours = $this->durationMinutes / 60;
        return "
        Livro Físico: {parent::getTitle()}
        ISBN: {parent::getIsbn()}
        Autor: {parent::getAuthor()->getName()}
        Ano de Publicação: {parent::publicationYear()}
        Páginas: {parent::pages}
        Duração: {$this->durationMinutes} minutos ({$hours} horas)
        ";
    }
}
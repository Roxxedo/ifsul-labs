<?php

namespace Source\Models\Library;

use DateTime;
use Source\Models\Library\Member;

class Loan {
    public int $id;
    public Member $member;
    public Book $book;
    public String $loanDate;
    public String $dueDate;
    public String $returnDate;

    public function __construct(int $id, Member $member, Book $book, String $loanDate, String $dueDate, String $returnDate) {
        $this->id = $id;
        $this->member = $member;
        $this->book = $book;
        $this->loanDate = $loanDate;
        $this->dueDate = $dueDate;
        $this->returnDate = $returnDate;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getMember(): Member {
        return $this->member;
    }

    public function setMember(Member $member) {
        $this->member = $member;
    }

    public function getBook(): Book {
        return $this->book;
    }

    public function setBook(Book $book) {
        $this->book = $book;
    }

    public function getLoanDate(): String {
        return $this->loanDate;
    }

    public function setLoanDate(String $loanDate) {
        $this->loanDate = $loanDate;
    }

    public function getDueDate(): String {
        return $this->dueDate;
    }

    public function setDueDate(String $dueDate) {
        $this->dueDate = $dueDate;
    }

    public function getReturnDate(): String {
        return $this->returnDate;
    }

    public function setReturnDate(String $returnDate) {
        $this->returnDate = $returnDate;
    }

    public function isOverdue(): bool {
        return DateTime::createFromFormat("d-m-Y", $this->returnDate) > DateTime::createFromFormat("d-m-Y", $this->dueDate);
    }

    public function calculateFine() {
        if (!$this->isOverdue()) {
            return 0;
        }
        
    }
}
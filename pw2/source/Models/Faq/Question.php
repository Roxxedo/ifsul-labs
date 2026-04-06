<?php

namespace Source\Models\Faq;

use Source\Models\Faq\Type;

class Question {
    private int $id;
    private string $question;
    private string $answer;
    private Type $type;

    public function __construct(int $id, string $question, string $answer, Type $type) {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
        $this->type = $type;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getQuestion(): string {
        return $this->question;
    }

    public function getAnswer(): string {
        return $this->answer;
    }

    public function getType(): Type {
        return $this->type;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function setQuestion(string $question) {
        $this->question = $question;
    }

    public function setAnswer(string $answer) {
        $this->answer = $answer;
    }

    public function setType(Type $type) {
        $this->type = $type;
    }

    public function show() {
        echo "FAQ #{$this->id} <br>";
        echo "Categoria: {$this->type->getName()} <br>";
        echo "Pergunta: {$this->question} <br>";
        echo "Resposta: {$this->answer} <br>";
    }
}
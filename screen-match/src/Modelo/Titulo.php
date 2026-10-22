<?php

abstract class Titulo implements Avaliavel {

    use ComAvalicao;

    public function __construct(
        public readonly string $nome,
        public readonly int $anoLancamento,
        public readonly Genero $genero,
    ) {
        $this->notas = [];
    }

    abstract public function duracaoEmMinutos(): int;
}

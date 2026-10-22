<?php

namespace ScreenMatch\Modelo;

class Episodio implements Avaliavel {

    use ComAvalicao;

    public function __construct(
        public readonly Serie $serie,
        public readonly string $nome,
        public readonly int $numero,
    ) {
        $this->notas = [];
    }
}
